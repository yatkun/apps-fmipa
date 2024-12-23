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
       $query->where('kriteria', 'like', "%{$value}%")
       ->orWhere('nama', 'like', "%{$value}%")
       ->orWhere('keterangan', 'like', "%{$value}%");
    }

}
