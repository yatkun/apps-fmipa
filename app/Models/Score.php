<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded=[];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Quiz (bisa dihubungkan dengan model Quiz jika ada)
    public function jenissoal()
    {
        return $this->belongsTo(Jenissoal::class);
    }
}
