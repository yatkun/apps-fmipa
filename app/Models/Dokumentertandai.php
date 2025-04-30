<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumentertandai extends Model
{
    use HasFactory;
    protected $guarded;

    /**
     * Relasi ke pengguna yang mengunggah dokumen.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Relasi banyak ke banyak dengan pengguna yang ditandai dalam dokumen.
     */
    public function pengguna()
    {
        return $this->belongsToMany(User::class, 'document_user', 'document_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'like', "%{$value}%")
            ->orWhere('created_at', 'like', "%{$value}%")
            ->orWhere('user_id', 'like', "%{$value}%");
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }
}
