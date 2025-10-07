<?php

namespace App\Livewire\IKU;

use App\Livewire\Forms\IkuenamForm;
use App\Models\Ikuenam;
use Livewire\Component;
use Livewire\WithPagination;

class Iku6 extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $mode = 'add';

    public IkuenamForm $form;

    protected $listeners = ['confirmDelete'];

    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
        $this->dispatch('closemodal');
    }

    public function deleteIku6($id)
    {
        $this->dispatch('showDeleteConfirmation', id: $id);
    }

    public function confirmDelete($id)
    {
        Ikuenam::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif');
        $this->resetPage();
    }

    public function update($data)
    {

        $this->mode = 'edit';
        $this->dispatch('modalIku6');
        $this->form->ikuenam_id = $data['id'];
        $this->form->nama = $data['nama'];
        $this->form->kriteria = $data['kriteria'];
        $this->form->bukti = $data['bukti'];
    }
    public function update_a()
    {

        $this->form->update();
        $this->dispatch('iku1store');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
        $this->dispatch('closemodal');
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
    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
    }

    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->kriteria = '';
        $this->form->bukti = '';
    }

    public function cancelEdit()
    {
        $this->resetInput(); // Clear form fields
        $this->mode = 'add'; // Switch back to 'add' mode
    }

    public function handleSaveOrUpdate()
    {
        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->save(); // Panggil fungsi save
        }
    }
    public function render()
    {
        return view('livewire.IKU.iku6', [
            'a' => Ikuenam::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
