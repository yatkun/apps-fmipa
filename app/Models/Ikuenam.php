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
}
