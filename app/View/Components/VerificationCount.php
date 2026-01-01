<?php

namespace App\View\Components;

use App\Models\Letter;
use Illuminate\View\Component;

class VerificationCount extends Component
{
    public $count;

    public function __construct()
    {
        // Hitung jumlah surat yang perlu verifikasi tendik dan waiting template

        $this->count = Letter::where('status', 'verification_tendik')
            ->orWhere('status', 'waiting_template')
            ->count();


        // $this->count = Letter::where('status', 'verification_tendik')
        //      ->and
        //     ->count();
    }

    public function render()
    {
        return view('components.verification-count');
    }
}