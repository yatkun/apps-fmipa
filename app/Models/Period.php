<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active period
     */
    public static function getActivePeriod()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Set this period as active and deactivate others
     */
    public function setAsActive()
    {
        // Deactivate all other periods
        self::where('id', '!=', $this->id)->update(['is_active' => false]);
        
        // Activate this period
        $this->update(['is_active' => true]);
    }

    /**
     * Scope to get only active periods
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Relationships
     */
    public function ikusatus()
    {
        return $this->hasMany(Ikusatu::class);
    }

    public function ikuduas()
    {
        return $this->hasMany(Ikudua::class);
    }

    public function ikutigas()
    {
        return $this->hasMany(Ikutiga::class);
    }

    public function ikuempats()
    {
        return $this->hasMany(Ikuempat::class);
    }

    public function ikulimas()
    {
        return $this->hasMany(Ikulima::class);
    }

    public function ikuenams()
    {
        return $this->hasMany(Ikuenam::class);
    }

    public function ikutujahs()
    {
        return $this->hasMany(Ikutujuh::class);
    }

    public function ikudelapans()
    {
        return $this->hasMany(Ikudelapan::class);
    }
}
