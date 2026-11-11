<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_EDITOR = 'editor';
    public const ROLE_KONTRIBUTOR = 'kontributor';

    public const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super Admin (PMO / Tim TI)',
        self::ROLE_EDITOR => 'Editor (Peneliti / Humas)',
        self::ROLE_KONTRIBUTOR => 'Kontributor (Tim Lapangan)',
    ];

    protected $fillable = ['name', 'email', 'password', 'role', 'is_active'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active && array_key_exists($this->role, self::ROLES);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /** Editor atau Super Admin: boleh mengelola & menerbitkan semua konten. */
    public function canPublish(): bool
    {
        return in_array($this->role, [self::ROLE_SUPER_ADMIN, self::ROLE_EDITOR], true);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'author_id');
    }
}
