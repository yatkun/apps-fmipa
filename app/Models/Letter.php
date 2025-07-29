<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $guarded = [];
    use HasFactory;

    protected $casts = [
        'data_filled' => 'array',
        'approved_at' => 'datetime', // Untuk casting otomatis ke objek DateTime
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

    // Relasi ke User yang membuat surat (jika ada kolom user_id)
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $term)
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where(function ($subQuery) use ($term) {
                $subQuery->Where('letters.created_at', 'like', "%$term%")
                    ->orWhere('letters.approved_at', 'like', "%$term%")
                    ->orWhereHas('template', function ($tq) use ($term) {
                        $tq->where('name', 'like', "%$term%");
                    });
            });
        });
    }
}
