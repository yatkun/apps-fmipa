<?php

namespace App\Livewire\Edokumen\pribadi;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendidikan as ModelsPendidikan;


class Pendidikan extends Component
{
    public $title = 'Dokumen Pendidikan';

    use WithFileUploads;
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';
 
    public $existingFile;

    public $mode = 'add';

    public $nama;
    public $document;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'document' => 'required|file|max:12240',
    ];

    protected $messages = [
        'nama.required' => 'Nama dokumen harus diisi',
        'nama.max' => 'Maksimal 255 karakter',
        'document.required' => 'Dokumen harus dipilih',
        'document.max' => 'Dokumen maksimal 10 MB',
    ];

    // public function updatedDocument()
    // {
    //     $this->validateOnly('document');
    // }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    private function resetInput()
    {
        $this->nama = '';
        $this->document = '';
        $this->existingFile = '';
    }

    public function upload(){

        $this->validate();
        $username = Auth::user()->username;

        $originalName = $this->nama;
        $extension = $this->document->getClientOriginalExtension();
        $timestamp = Carbon::now()->format('Ymd_His');

        $fileName = Str::slug($originalName) . "_{$timestamp}.{$extension}";

        // $this->document->storeAs('documents', $fileName, 'public');
        $googleFolder = "documents-pribadi/pendidikan/{$username}";

        if (!Storage::disk('google')->exists($googleFolder)) {
            Storage::disk('google')->makeDirectory($googleFolder);
        }
        Storage::disk('google')->put("{$googleFolder}/{$fileName}", file_get_contents($this->document->getRealPath()));

        $filePath = "{$googleFolder}/{$fileName}";


        // Simpan informasi file ke database dengan user_id
     
        
        
        $data = ModelsPendidikan::create([
            'nama' => $this->nama,
            'document' => $this->document,
            'user_id' => Auth::id()
        ]);
        session()->flash('success', 'Dokumen berhasil ditambahkan !');
        $this->dispatch('notif');
        $this->resetInput();

        $this->dispatch('closemodal');
    }

    public function handleSaveOrUpdate()
    {

        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->upload(); // Panggil fungsi save
        }
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
    }

    public function download($document)
    {
  
        $file = ModelsPendidikan::findOrFail($document);
    
        $filePath = $file->document;
        $fileName = basename($filePath);

    
        // Periksa apakah file ada di Google Drive
        if (!Storage::disk('google')->exists($filePath)) {
            session()->flash('error', 'File not found on Google Drive');
            return;
        }

         // Ambil konten file dari Google Drive
         $fileContent = Storage::disk('google')->get($filePath);
         // Kembalikan sebagai response download
         return response()->streamDownload(function () use ($fileContent) {
             echo $fileContent;
         }, $fileName);
    }

    public function render()
    {
        
        return view('livewire.EDOKUMEN.pribadi.pendidikan',[
            'title' => $this->title,
            'a' => ModelsPendidikan::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
   
    }
}
