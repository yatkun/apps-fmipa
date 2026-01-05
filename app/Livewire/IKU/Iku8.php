<?php

namespace App\Livewire\IKU;

use Livewire\Component;

class Iku8 extends Component
{
    protected $listeners = ['confirmDelete', 'period-changed' => 'handlePeriodChanged'];

    public function handlePeriodChanged()
    {
        // Empty method for now as Iku8 doesn't have pagination
    }

    public function render()
    {
        return view('livewire.IKU.iku8');
    }
}
