<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Template; // Import Model Template

class ListTemplates extends Component
{
    // Properti untuk menyimpan daftar template

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    // Method `mount` akan dijalankan sekali saat komponen diinisialisasi
    public function mount()
    {
        // $this->templates = Template::when($this->sortDir, function ($query) {
        //     $query->orderBy($this->sortBy, $this->sortDir);
        // }, function ($query) {
        //     $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
        // })
        //     ->search($this->search)
        //     ->paginate($this->perPage);
    }

    // Method untuk mengunduh template
    public function downloadTemplate($templateId)
    {
        $template = Template::find($templateId);
        if ($template && \Illuminate\Support\Facades\Storage::disk('public')->exists($template->file_path)) {
            $filePath = \Illuminate\Support\Facades\Storage::disk('public')->path($template->file_path);
            $fileName = $template->name . '.docx';
            
            return response()->download($filePath, $fileName);
        } else {
            session()->flash('error', 'Template tidak ditemukan atau file tidak ada.');
            return;
        }
    }

    // Method untuk menghapus template
    public function deleteTemplate($templateId)
    {
        $template = Template::find($templateId);
        if ($template) {
            // Hapus file dari storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($template->file_path);
            // Hapus entri dari database
            $template->delete();
            // Refresh daftar template
            session()->flash('success', 'Template berhasil dihapus!');
            $this->mount();
        } else {
            session()->flash('error', 'Template tidak ditemukan.');
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
    public function render()
    {

        $templates = Template::when($this->sortDir, function ($query) {
            $query->orderBy($this->sortBy, $this->sortDir);
        }, function ($query) {
            $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
        })
            ->search($this->search)
            ->paginate($this->perPage);


        return view('livewire.edokumen.tendik.persuratan.list-templates', [
            'templates' => $templates, // Teruskan objek paginasi langsung ke view

        ]);
    }
}