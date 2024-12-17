<?php

namespace App\Livewire\Eskripsi;

use App\Models\User;
use App\Models\Skripsi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\Eskripsi as FormsEskripsi;

#[Layout('components.layouts.eskripsi')] 
class Eskripsi extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';
    public $mode = 'add';

    public FormsEskripsi $form;

    protected $listeners = ['confirmDelete'];


    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('skripsistore');
    }

    public function deleteskripsi($id)
    {
        $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    }

    public function confirmDelete($id)
    {
        Eskripsi::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif'); // Emit any notification event if needed
    }
    
    public function update($data)
    {

        $this->mode = 'edit';
        $this->dispatch('modalSkripsi');
        $this->form->skripsi_id = $data['id'];
        $this->form->judul = $data['judul'];
        $this->form->nama = $data['nama'];
        $this->form->pembimbing_1 = $data['pembimbing_1'];
        $this->form->pembimbing_2 = $data['pembimbing_2'];
  
    }
    public function update_a()
    {

        $this->form->update();
        $this->dispatch('skripsistore');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
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
    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
    }

    private function resetInput()
    {
        $this->form->nama = '';
        $this->form->judul = '';
        $this->form->pembimbing_1 = '';
        $this->form->pembimbing_2 = '';
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
       
        
        return view('livewire.e-skripsi.eskripsi', [
            'a' => Skripsi::when($this->sortDir, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            }, function ($query) {
                $query->orderBy('created_at', 'DESC'); // urutkan sesuai data terbaru (default)
            })
                ->search($this->search)
                ->paginate($this->perPage),
            
            'dosen' => User::where('level', 'dosen')->get()
        ]);
        
    }
}
