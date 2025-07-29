<?php

namespace App\Models;

use App\Models\BimbinganDocument;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bimbingan extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'like', "%{$value}%")
            ->orWhere('created_at', 'like', "%{$value}%")
            ->orWhere('nim', 'like', "%{$value}%")
            ->orWhere('prodi', 'like', "%{$value}%")
            ->orWhere('pembimbing_1', 'like', "%{$value}%")
            ->orWhere('pembimbing_2', 'like', "%{$value}%")
            ->orWhere('angkatan', 'like', "%{$value}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function documents()
    {
        return $this->hasMany(BimbinganDocument::class);
    }

    public function pembimbingSatu()
    {
        return $this->belongsTo(User::class, 'pembimbing_1');
    }

    public function pembimbingDua()
    {
        return $this->belongsTo(User::class, 'pembimbing_2');
    }
}
