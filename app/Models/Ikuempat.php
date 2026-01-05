<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikuempat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('kriteria', 'like', "%{$value}%")
       ->orWhere('keterangan', 'like', "%{$value}%");
    }

    /**
     * Scope to filter by session selected period
     */
    public function scopeBySessionPeriod($query)
    {
        $selectedPeriod = session('selected_period');
        
        if ($selectedPeriod === 'all') {
            return $query;
        } elseif ($selectedPeriod) {
            return $query->where('period_id', $selectedPeriod);
        }
        
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            return $query->where('period_id', $activePeriod->id);
        }
        return $query;
    }
}
