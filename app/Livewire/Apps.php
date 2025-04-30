<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.template')] 
class Apps extends Component
{

    public function iku1()
    {
        session()->flash('success', 'Selamat Datang di Aplikasi IKU !');
        
        return redirect()->route('iku.dashboard');
       
    }
    public function edokumen()
    {
        session()->flash('success', 'Selamat Datang di Aplikasi E-DOKUMEN !');
        
        return redirect()->route('edokumen.dashboard');
       
    }

    public function eskripsi()
    {
        session()->flash('success', 'Selamat Datang di Aplikasi E-Skripsi !');
        
        return redirect()->route('eskripsi');
       
    }
    public function choose($application)
    {
        
        session(['selected_application' => $application]); // Simpan aplikasi yang dipilih di sesi
       
        $applications = session('authenticated_application');
        if(Auth::user() && ($applications == 'EDokumen') && (session('selected_application') == 'EDokumen')){
            return redirect()->route('edokumen.dashboard');
        }elseif (Auth::user() && ($applications == 'IKU') && (session('selected_application') == 'IKU')){
            return redirect()->route('iku.dashboard');
        }

   
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.apps');
    }
}
