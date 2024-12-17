<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skripsi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('judul', 'like', "%{$value}%")
       ->orWhere('pembimbing_1', 'like', "%{$value}%")
       ->orWhere('pembimbing_2', 'like', "%{$value}%");
    }
}
