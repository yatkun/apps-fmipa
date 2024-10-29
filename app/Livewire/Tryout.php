<?php

namespace App\Livewire;

use App\Models\Jenissoal;
use Livewire\Component;

class Tryout extends Component
{
    public function render()
    {
        $paket = Jenissoal::all();
        return view('livewire.tryout',[
            'paket' => $paket
        ]);
    }
}
