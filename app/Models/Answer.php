<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Question
    public function question()
    {
        return $this->belongsTo(Soal::class);
    }

    // Relasi dengan Option
    public function option()
    {
        return $this->belongsTo(Pilihan::class);
    }
}
