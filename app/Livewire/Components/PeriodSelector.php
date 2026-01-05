<?php

namespace App\Livewire\Components;

use App\Models\Period;
use Livewire\Component;

class PeriodSelector extends Component
{
    public $selectedPeriod = 'all';
    
    #[\Livewire\Attributes\Locked]
    public $periods = [];

    public function mount()
    {
        $this->periods = Period::all();
        
        if (session('selected_period')) {
            $this->selectedPeriod = session('selected_period');
        }
    }

    public function selectPeriod($periodId)
    {
        session(['selected_period' => $periodId]);
        $this->selectedPeriod = $periodId;
        
        $this->dispatch('period-changed');
    }

    public function render()
    {
        return view('livewire.components.period-selector');
    }
}
