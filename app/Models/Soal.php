<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(Pilihan::class);
    }

    public function jenissoal()
    {
        return $this->belongsTo(Jenissoal::class);
    }
}
