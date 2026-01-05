<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikusatu extends Model
{

    protected $guarded = [];
    use HasFactory;

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('program_studi', 'like', "%{$value}%")
       ->orWhere('tanggal_lulus', 'like', "%{$value}%")
       ->orWhere('pekerjaan', 'like', "%{$value}%")
       ->orWhere('pendapatan', 'like', "%{$value}%")
       ->orWhere('masa_tunggu', 'like', "%{$value}%")
       ->orWhere('bobot', 'like', "%{$value}%");
    }

    /**
     * Get the period that owns the Ikusatu
     */
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Scope to filter by active period
     */
    public function scopeActivePeriod($query)
    {
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            return $query->where('period_id', $activePeriod->id);
        }
        return $query;
    }

    /**
     * Scope to filter by session selected period
     */
    public function scopeBySessionPeriod($query)
    {
        $selectedPeriod = session('selected_period');
        
        if ($selectedPeriod === 'all') {
            // Return all data
            return $query;
        } elseif ($selectedPeriod) {
            // Return data for specific period
            return $query->where('period_id', $selectedPeriod);
        }
        
        // If no period selected in session, use active period
        $activePeriod = Period::getActivePeriod();
        if ($activePeriod) {
            return $query->where('period_id', $activePeriod->id);
        }
        return $query;
    }
}
