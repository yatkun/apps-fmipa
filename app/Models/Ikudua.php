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
       ->orWhere('bobot', 'like', "%{$value}%")
       ->orWhere('triwulan', 'like', "%{$value}%")
        ->orWhere('tahun', 'like', "%{$value}%"); // Tambahkan ini agar tahun bisa dicari
    }

    
}
