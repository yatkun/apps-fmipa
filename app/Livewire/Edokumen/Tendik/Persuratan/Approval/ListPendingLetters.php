<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approval;

use App\Models\Letter;
use Livewire\Component;

class ListPendingLetters extends Component
{
    public $pendingLetters;

    public function mount()
    {
        // Ambil semua surat dengan status 'pending', diurutkan berdasarkan tanggal terbaru
        // Dengan eager loading template untuk menampilkan nama template
        // Sesuaikan dengan user yang berhak melihat (misal: jika ada role Dekan)
        // if (auth()->user()->hasRole('dekan')) { // Contoh jika pakai Spatie Roles & Permissions
            $this->pendingLetters = Letter::where('status', 'pending')
                                        ->with('template')
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        // } else {
        //     abort(403, 'Anda tidak memiliki akses untuk melihat halaman ini.');
        // }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.approval.list-pending-letters');
    }
}
