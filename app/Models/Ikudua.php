<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikudua extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('program_studi', 'like', "%{$value}%")
       ->orWhere('sks_juara', 'like', "%{$value}%")
       ->orWhere('level', 'like', "%{$value}%")
       ->orWhere('keterangan', 'like', "%{$value}%")
       ->orWhere('kategori', 'like', "%{$value}%")
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
