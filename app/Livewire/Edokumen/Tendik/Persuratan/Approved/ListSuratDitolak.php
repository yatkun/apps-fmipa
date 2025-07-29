<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approved;

use App\Models\Letter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ListSuratDitolak extends Component
{

     use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function mount()
    {

    
    }


    public function downloadLetter($filePath)
    {
        
        if (Storage::disk('generated_letters')->exists($filePath)) {
            return Storage::download($filePath);
        }

        session()->flash('error', 'File surat tidak ditemukan.');
        // Redirect kembali ke halaman daftar atau refresh component jika perlu
        return redirect()->back();
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
    public function render()
    {
        $tolak = Letter::query()
            ->select('letters.*')
            ->join('templates', 'letters.template_id', '=', 'templates.id')
            ->where('status', 'rejected')
            ->with('template', 'approver')
            ->when($this->sortDir && $this->sortBy, function ($query) {
                if ($this->sortBy === 'template_name') {
                    $query->orderBy('templates.name', $this->sortDir);
                } elseif ($this->sortBy === 'approver_name') {
                    $query->join('users as approvers', 'letters.approver_id', '=', 'approvers.id')
                        ->orderBy('approvers.name', $this->sortDir);
                } else {
                    $query->orderBy($this->sortBy, $this->sortDir);
                }
            }, function ($query) {
                $query->orderBy('created_at', 'DESC');
            })
            ->search($this->search)
            ->paginate($this->perPage);
        return view('livewire.edokumen.tendik.persuratan.approved.list-surat-ditolak',[
            'tolak' => $tolak
        ]);
    }
}
