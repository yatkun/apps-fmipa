<?php

namespace App\Livewire\Edokumen\Tendik;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $this->dispatch('notif');
        return view('livewire.edokumen.tendik.dashboard');
    }
}
