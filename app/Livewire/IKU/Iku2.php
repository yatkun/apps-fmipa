<?php

namespace App\Livewire\IKU;

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

    protected $listeners = ['confirmDelete'];
    public function save()
    {
        $this->form->store_a();
        session()->flash('success', 'Data berhasil ditambahkan !');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('iku1store');
    }

    public function modes()
    {
        $this->resetInput();
        $this->mode = 'add';
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

    public function deleteIku2a($id)
    {
        $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    }

    public function deleteIku2b($id)
    {
        $this->dispatch('showDeleteConfirmation', $id); // Emit an event to show the confirmation dialog
    }

    public function confirmDelete($id)
    {
        Ikudua::where('id', $id)->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif'); // Emit any notification event if needed
    }




    public function updatea($data)
    {
        $this->mode = 'edit';
        $this->dispatch('modalIku2a');
        $this->form->ikudua_id = $data['id'];
        $this->form->nama = $data['nama'];
        $this->form->program_studi = $data['program_studi'];
        $this->form->sks_juara = $data['sks_juara'];
        $this->form->keterangan = $data['keterangan'];
    }

    public function updateb($data)
    {
        $this->mode = 'edit';
        $this->dispatch('modalIku2b');
        $this->form->ikudua_id = $data['id'];
        $this->form->nama = $data['nama'];
        $this->form->program_studi = $data['program_studi'];
        $this->form->sks_juara = $data['sks_juara'];
        $this->form->level = $data['level'];
        $this->form->keterangan = $data['keterangan'];
    }

    public function handleSaveOrUpdate()
    {
        if ($this->mode == 'edit') {
            $this->update_a(); // Panggil fungsi update
        } else {
            $this->save(); // Panggil fungsi save
        }
    }

    public function handleSaveOrUpdateb()
    {
        if ($this->mode == 'edit') {
            $this->update_b(); // Panggil fungsi update
        } else {
            $this->saveb(); // Panggil fungsi save
        }
    }
    public function update_a()
    {


        $this->form->updatea();

        $this->dispatch('iku1store');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
    }

    public function update_b()
    {


        $this->form->updateb();

        $this->dispatch('iku1store');
        session()->flash('success', 'Data berhasil diupdate !');
        $this->resetInput();
        $this->mode = 'add';
        // Emit event untuk JavaScript
        $this->dispatch('notif');
    }

    public function render()
    {
        return view('livewire.iku.iku2', [
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
