<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikuenam extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scopeSearch($query, $value)
    {
       $query->where('kriteria', 'like', "%{$value}%")
       ->orWhere('nama', 'like', "%{$value}%")
       ->orWhere('bobot', 'like', "%{$value}%");
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
