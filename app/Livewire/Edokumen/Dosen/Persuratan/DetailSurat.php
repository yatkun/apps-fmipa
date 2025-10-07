<?php

namespace App\Livewire\EDOKUMEN\Dosen\Persuratan;

use Livewire\Component;
use App\Models\Letter;

class DetailSurat extends Component
{
    public $letter;

    public function mount($letterId)
    {
        if (is_numeric($letterId)) {
            $this->letter = \App\Models\Letter::findOrFail($letterId);
        } else {
            if (method_exists(\App\Models\Letter::class, 'decodeHashedId')) {
                $decoded = \App\Models\Letter::decodeHashedId($letterId);
                $this->letter = \App\Models\Letter::findOrFail($decoded);
            } else {
                abort(404, 'Surat tidak ditemukan');
            }
        }
    }

    public function render()
    {
        return view('livewire.EDOKUMEN.dosen.persuratan.detail-surat', [
            'letter' => $this->letter,
        ]);
    }
}
