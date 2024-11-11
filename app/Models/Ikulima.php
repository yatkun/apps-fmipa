<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikulima extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('jenis_karya', 'like', "%{$value}%")
       ->orWhere('kriteria', 'like', "%{$value}%")
       ->orWhere('tanggal', 'like', "%{$value}%")
       ->orWhere('keterangan', 'like', "%{$value}%")
       ->orWhere('bobot', 'like', "%{$value}%");
    }
}
