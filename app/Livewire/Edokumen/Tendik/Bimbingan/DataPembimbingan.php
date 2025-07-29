<?php

namespace App\Livewire\Edokumen\Tendik\Bimbingan;

use Livewire\Component;
use App\Models\Bimbingan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataPembimbingan extends Component
{
    public $title = 'Data Pembimbingan';


    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    public function mount()
    {
        $this->dispatch('notif');
        
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

    public function delete($id)
    {
      
        $file = Bimbingan::findOrFail($id);
        $filePath = $file->document;

        if (Storage::disk('google')->exists($filePath)) {
            Storage::disk('google')->delete($filePath);
        }

        $file->delete();

        session()->flash('success', 'Dokumen berhasil dihapus');
        $this->dispatch('notif'); 
    
        
    }


    public function render()
    {
        return view('livewire.edokumen.tendik.bimbingan.data-pembimbingan',[
            'title' => $this->title,
            'a' => Bimbingan::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
