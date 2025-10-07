<?php

namespace App\Livewire\IKU;

use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodManager extends Component
{
    use WithPagination;

    public $name;
    public $year_start;
    public $year_end;
    public $description;
    public $editingId = null;
    public $showModal = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'year_start' => 'required|integer|min:2020|max:2100',
        'year_end' => 'required|integer|min:2020|max:2100',
        'description' => 'nullable|string',
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->year_start = '';
        $this->year_end = '';
        $this->description = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $period = Period::find($this->editingId);
            $period->update([
                'name' => $this->name,
                'year_start' => $this->year_start,
                'year_end' => $this->year_end,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Periode berhasil diupdate!');
        } else {
            Period::create([
                'name' => $this->name,
                'year_start' => $this->year_start,
                'year_end' => $this->year_end,
                'description' => $this->description,
                'is_active' => false,
            ]);
            session()->flash('success', 'Periode berhasil ditambahkan!');
        }

        $this->closeModal();
        $this->dispatch('period-saved');
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        $this->editingId = $period->id;
        $this->name = $period->name;
        $this->year_start = $period->year_start;
        $this->year_end = $period->year_end;
        $this->description = $period->description;
        $this->showModal = true;
    }

    public function setActive($id)
    {
        $period = Period::findOrFail($id);
        $period->setAsActive();
        session()->flash('success', 'Periode "' . $period->name . '" telah diaktifkan!');
        $this->dispatch('period-activated');
    }

    public function delete($id)
    {
        $period = Period::findOrFail($id);
        
        if ($period->is_active) {
            session()->flash('error', 'Tidak dapat menghapus periode yang sedang aktif!');
            return;
        }

        $period->delete();
        session()->flash('success', 'Periode berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.IKU.period-manager', [
            'periods' => Period::orderBy('year_start', 'desc')->paginate(10),
            'activePeriod' => Period::getActivePeriod(),
        ]);
    }
}
