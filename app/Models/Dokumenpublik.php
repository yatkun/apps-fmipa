<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenpublik extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $value)
    {
       $query->where('nama', 'like', "%{$value}%")
       ->orWhere('created_at', 'like', "%{$value}%")
       ->orWhere('user_id', 'like', "%{$value}%");
    }
}
