<?php

namespace App\Livewire;

use App\Models\Ikudelapan;
use App\Models\Ikudua;
use App\Models\Ikuenam;
use App\Models\Ikulima;
use App\Models\Ikusatu;
use App\Models\Ikutiga;
use App\Models\Ikutujuh;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        
        return view('livewire.dashboard',[
            'a' => Ikusatu::all()->count(),
            'b' => Ikudua::all()->count(),
            'c' => Ikutiga::all()->count(),
          
            'e' => Ikulima::all()->count(),
            'f' => Ikuenam::all()->count(),
            'g' => Ikutujuh::all()->count(),
            
        ]);
    }
}
