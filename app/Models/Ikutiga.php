<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikutiga extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('kriteria', 'like', "%{$value}%")
       ->orWhere('keterangan', 'like', "%{$value}%")
       ->orWhere('bobot', 'like', "%{$value}%");
    }
}
