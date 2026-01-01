<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approval;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class ListPendingLetters extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $previewUrl;
    public $previewLetter;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDir' => ['except' => 'DESC'],
        'perPage' => ['except' => 10],
    ];

    public function resetPreview(){
        $this->previewUrl = null;
        $this->previewLetter = null;
    }

    public function preview($letterId)
    {
        try {
            $letter = Letter::with('template')->findOrFail($letterId);
            
            // Check permission - hanya creator atau admin/tendik/dekan yang bisa akses
            if (Auth::id() !== $letter->user_id && !in_array(Auth::user()->level, ['Admin', 'Tendik', 'Dekan'])) {
                session()->flash('error', 'Anda tidak memiliki akses untuk melihat surat ini.');
                return;
            }
            
            $filePath = $letter->file_path;
            
            if (!$filePath) {
                session()->flash('error', 'File surat tidak ditemukan.');
                return;
            }
            
            // Cek apakah file di Google Drive
            if (str_starts_with($filePath, 'Surat/')) {
                if (!Storage::disk('google')->exists($filePath)) {
                    session()->flash('error', 'File tidak ditemukan di Google Drive.');
                    return;
                }
                
                // Ambil konten file dari Google Drive
                $fileContent = Storage::disk('google')->get($filePath);
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $contentType = $extension === 'pdf' ? 'application/pdf' : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                
                // Encode ke base64 untuk ditampilkan di PDF viewer
                $base64Content = base64_encode($fileContent);
                $this->previewUrl = "data:application/pdf;base64,{$base64Content}";
                
                // Set preview letter with name from template if available
                $this->previewLetter = $letter;
                $this->previewLetter->title = $letter->template ? $letter->template->name : $letter->title;
                
                // Set filename dari path file
                $fileName = pathinfo($filePath, PATHINFO_BASENAME);
              
                $this->previewLetter->fileName = $fileName;
             
                
                
            } else {
                session()->flash('error', 'File tidak tersedia untuk preview.');
            }
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memuat preview dokumen: ' . $e->getMessage());
        }
    }

    public function mount()
    {
         $this->dispatch('notif');
        // Reset pagination when component is mounted
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function setsortBy($sortByField)
    {
        // Jika field yang sama diklik
        if ($this->sortBy === $sortByField) {
            // Jika saat ini ASC, ubah menjadi DESC
            if ($this->sortDir === 'ASC') {
                $this->sortDir = 'DESC';
            }
            // Jika saat ini DESC, reset ke default
            elseif ($this->sortDir === 'DESC') {
                $this->sortDir = 'ASC';  // null berarti urutan default
                $this->sortBy = 'created_at';  // kembali ke default sorting
            }
            // Jika saat ini null (default), set ke ASC
            else {
                $this->sortDir = 'ASC';
            }
        } else {
            // Jika field yang berbeda diklik, set ke ASC
            $this->sortBy = $sortByField;
            $this->sortDir = 'ASC';
        }

        // Reset pagination when sorting changes
        $this->resetPage();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
    }
    public function render()
    {
        $pendingLetters = Letter::where('user_id', Auth::user()->id)
            ->with('template', 'creator', 'tendikVerifier')
            // orwhere status except 'approved'

            ->orderBy($this->sortBy, $this->sortDir)
            ->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.EDOKUMEN.tendik.persuratan.approval.list-pending-letters', compact('pendingLetters'));
    }
}
