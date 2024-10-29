<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    use HasFactory;

    protected   $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
