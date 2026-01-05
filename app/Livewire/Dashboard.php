<?php

namespace App\Livewire;

use App\Models\Ikudelapan;
use App\Models\Ikudua;
use App\Models\Ikuempat;
use App\Models\Ikuenam;
use App\Models\Ikulima;
use App\Models\Ikusatu;
use App\Models\Ikutiga;
use App\Models\Ikutujuh;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['period-changed' => 'handlePeriodChanged'];

    public function handlePeriodChanged()
    {
        // Component akan re-render otomatis
    }

    public function render()
    {
        $this->dispatch('notif');
        
        return view('livewire.dashboard',[
            'a' => Ikusatu::bySessionPeriod()->count(),
            'b' => Ikudua::bySessionPeriod()->count(),
            'c' => Ikutiga::bySessionPeriod()->count(),
            'd' => Ikuempat::bySessionPeriod()->count(),   
            'e' => Ikulima::bySessionPeriod()->count(),
            'f' => Ikuenam::bySessionPeriod()->count(),
            'g' => Ikutujuh::bySessionPeriod()->count(),
            'h' => Ikudelapan::bySessionPeriod()->count(),
            
        ]);
    }
}
