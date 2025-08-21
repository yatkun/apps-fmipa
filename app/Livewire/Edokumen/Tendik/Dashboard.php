<?php

namespace App\Livewire\Edokumen\Tendik;

use App\Models\Letter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $this->dispatch('notif');
        
        // Data statistik untuk dashboard
        $dashboardData = [];
        
        // Jika user adalah dekan, tampilkan statistik approval
        if (Auth::user()->is_dekan) {
            $dashboardData = [
                'pending_letters' => Letter::where('status', 'pending')->count(),
                'approved_letters' => Letter::where('status', 'approved')->count(),
                'rejected_letters' => Letter::where('status', 'rejected')->count(),
                'total_letters' => Letter::count(),
                'recent_pending_letters' => Letter::where('status', 'pending')
                    ->with(['creator', 'template'])
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
            ];
        } else {
            // Data untuk tendik biasa
            $dashboardData = [
                'total_letters' => Letter::count(),
                'waiting_template_letters' => Letter::where('status', 'waiting_template')->count(),
            ];
        }
        
        return view('livewire.edokumen.tendik.dashboard', compact('dashboardData'));
    }
}
