<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.template')] 
class Apps extends Component
{

    public function iku1()
    {
        session()->flash('success', 'Selamat Datang di Aplikasi IKU !');
        
        return redirect()->route('iku.dashboard');
       
    }
    public function render()
    {
        return view('livewire.apps');
    }
}
