<?php

namespace App\Livewire\Edokumen;

use App\Models\Dokumenpublik;
use App\Models\Dokumensaya;
use App\Models\Dokumentertandai;
use App\Models\Letter;
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
        
        // Data tambahan untuk dekan
        $dekanData = [];
        if (Auth::user()->is_dekan) {
            $dekanData = [
                'pending_letters' => Letter::where('status', 'pending')->count(),
                'approved_letters' => Letter::where('status', 'approved')->count(),
                'rejected_letters' => Letter::where('status', 'rejected')->count(),
                'recent_pending_letters' => Letter::where('status', 'pending')
                    ->with(['creator', 'template'])
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get(),
            ];
        }
        
        $this->dispatch('notif');
        return view('livewire.EDOKUMEN.dashboard',[
               'title' => 'Dashboard',
               'a' => Dokumensaya::where('user_id', $id)->count(),
               'b' => Dokumenpublik::all()->count(),
               'c' => $dokumen,
               'dekanData' => $dekanData
        ]
        );
    }
}
