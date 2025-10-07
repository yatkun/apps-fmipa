<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $guarded = [];

    // Tambahkan baris ini
    protected $casts = [
        'placeholders' => 'array',
        'table_placeholders' => 'array', // Penting: cast sebagai array
        'placeholder_hints' => 'array',
        'placeholder_permissions' => 'array', // Cast permissions sebagai array
    ];
    use HasFactory;

    public function scopeSearch($query, $value)
    {
       $query->where('name', 'like', "%{$value}%")
       ->orWhere('created_at', 'like', "%{$value}%")
       ->orWhere('placeholders', 'like', "%{$value}%");
    }
}
