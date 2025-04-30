<?php

namespace App\Livewire\Edokumen;

use App\Models\Dokumenpublik;
use App\Models\Dokumensaya;
use App\Models\Dokumentertandai;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public function render()
    {

        
        $dokumen = Dokumentertandai::query()
            
            ->whereHas('pengguna', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->with('pengguna') // untuk eager loading data pengguna
            ->count();

        $id = Auth::user()->id;
        $this->dispatch('notif');
        return view('livewire.edokumen.dashboard',[
               'title' => 'Dashboard',
               'a' => Dokumensaya::where('user_id', $id)->count(),
               'b' => Dokumenpublik::all()->count(),
               'c' => $dokumen
        ]
        );
    }
}
