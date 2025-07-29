<?php

namespace App\Models;

use App\Models\Bimbingan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BimbinganDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bimbingan()
{
    return $this->belongsTo(Bimbingan::class);
}
}
