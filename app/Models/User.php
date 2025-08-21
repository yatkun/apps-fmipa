<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Skripsi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_dekan' => 'boolean',
        ];
    }

    /**
     * Check if user is a Dekan (Dosen with is_dekan = true)
     */
    public function isDekan(): bool
    {
        return $this->level === 'Dosen' && $this->is_dekan === true;
    }

    public function scopeSearch($query, $value)
    {
       $query->where('name', 'like', "%{$value}%")
       ->orWhere('username', 'like', "%{$value}%")
       ->orWhere('email', 'like', "%{$value}%");
    //    ->orWhere('user_id', 'like', "%{$value}%");
    }

    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class, 'id');
    }

    public function documents()
    {
        return $this->hasMany(Dokumentertandai::class, 'uploaded_by');
    }

    public function dokumen()
    {
        return $this->belongsToMany(Dokumentertandai::class, 'document_user','user_id', 'document_id');
    }
}
