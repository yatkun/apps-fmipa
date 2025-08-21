<?php

namespace App\Models;

use App\Traits\HasHashedId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory, HasHashedId;
    
    protected $guarded = [];
    
    protected $appends = ['hashed_id'];

    protected $casts = [
        'data_filled' => 'array',
        'approved_at' => 'datetime',
        'verified_at_tendik' => 'datetime',
        'verified_at_dekan' => 'datetime',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    // Relasi ke User yang menyetujui (jika ada)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    // Relasi ke User yang memverifikasi sebagai Tendik
    public function tendikVerifier()
    {
        return $this->belongsTo(User::class, 'verified_by_tendik_id');
    }

    // Relasi ke User yang memverifikasi sebagai Dekan
    public function dekanVerifier()
    {
        return $this->belongsTo(User::class, 'verified_by_dekan_id');
    }

    // Relasi ke User yang membuat surat (jika ada kolom user_id)
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Alias untuk relasi creator (untuk kompatibilitas)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $term)
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where(function ($subQuery) use ($term) {
                $subQuery->Where('letters.created_at', 'like', "%$term%")
                    ->orWhere('letters.approved_at', 'like', "%$term%")
                    ->orWhere('letters.title', 'like', "%$term%")
                    ->orWhereHas('template', function ($tq) use ($term) {
                        $tq->where('name', 'like', "%$term%");
                    });
            });
        });
    }
}
