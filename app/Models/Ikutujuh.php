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
}
