<?php

namespace App\Livewire\IKU;

use App\Models\Ikudelapan;
use App\Livewire\Forms\IkudelapanForm;
use Livewire\Component;
use Livewire\WithPagination;

class Iku8 extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $mode = 'add';

    public IkudelapanForm $form;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirmDelete', 'period-changed' => 'handlePeriodChanged'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function handlePeriodChanged()
    {
        $this->resetPage();
    }

    public function setsortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'ASC';
        }
    }

    public function modes()
    {
        $this->mode = 'add';
        $this->form->resetForm();
    }

    public function save()
    {
     
        $this->form->store();
        session()->flash('success', 'Data berhasil ditambahkan!');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('closemodal');
        $this->resetPage();
    }

    public function edit($id)
    {
        $data = Ikudelapan::find($id);
        if ($data) {
            $this->mode = 'edit';
            $this->form->fill($data);
            $this->form->ikudelapan_id = $id;
        }
    }

    public function update()
    {
        $this->form->update();
        session()->flash('success', 'Data berhasil diupdate!');
        $this->resetInput();
        $this->dispatch('notif');
        $this->dispatch('closemodal');
    }

    public function handleSaveOrUpdate()
    {
   
        if ($this->mode === 'edit') {
            $this->update();
        } else {
            $this->save();
        }
    }

    public function delete($id)
    {
        Ikudelapan::find($id)?->delete();
        session()->flash('success', 'Data berhasil dihapus!');
        $this->dispatch('notif');
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->form->resetForm();
        $this->mode = 'add';
    }

    public function render()
    {
        return view('livewire.IKU.iku8', [
            'iku8' => Ikudelapan::bySessionPeriod()
                ->orderBy($this->sortBy, $this->sortDir)
                ->search($this->search)
                ->paginate($this->perPage),
        ]);
    }
}
