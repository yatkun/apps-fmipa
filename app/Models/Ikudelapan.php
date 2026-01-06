<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikudelapan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $value)
    {
        $query->Where('program_studi', 'like', "%{$value}%");
       
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
