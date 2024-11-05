<?php

namespace App\Livewire;

use App\Models\Ikudua;
use App\Models\Ikusatu;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\IkuduaForm;
use App\Livewire\Forms\IkusatuForm;

class Iku2 extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $searcha = '';
    public $searchb = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

    public $mode = 'add';
    public IkuduaForm $form;


    public function save()
    {

        $this->form->store_a();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }

    public function saveb()
    {

        $this->form->store_b();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->program_studi = '';
        $this->form->sks_juara = '';
        $this->form->keterangan = '';
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
        return view('livewire.iku2', [
            'a' => Ikudua::where('kategori', 'Kegiatan Luar Prodi')->when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->searcha)
                ->paginate($this->perPage),

            'b' => Ikudua::where('kategori', 'Prestasi')->when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->searchb)
                ->paginate($this->perPage),
        ]);
    }
}
