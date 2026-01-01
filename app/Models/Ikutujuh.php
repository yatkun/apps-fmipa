<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikutujuh extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('mata_kuliah', 'like', "%{$value}%")
       ->orWhere('semester', 'like', "%{$value}%")
       ->orWhere('link', 'like', "%{$value}%")
       ->orWhere('bobot', 'like', "%{$value}%");
    }

    /**
     * Get the period that owns the Ikutujuh
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
}
