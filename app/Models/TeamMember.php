<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    public const GROUPS = [
        'peneliti' => 'Tim Peneliti',
        'pelaksana' => 'Tim Pelaksana (RA, PMO & TI)',
    ];

    protected $fillable = [
        'name', 'position', 'expertise', 'group', 'institution', 'bio', 'photo', 'order_index', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('order_index');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::disk('public')->url($this->photo) : null;
    }

    /** Inisial nama tanpa gelar, untuk avatar pengganti foto. */
    public function getInitialsAttribute(): string
    {
        $name = preg_replace('/^(dr\.rer\.nat\.|dr\.|prof\.)\s*/i', '', $this->name);
        $name = trim(explode(',', $name)[0]);
        $parts = preg_split('/\s+/', $name);

        return mb_strtoupper(mb_substr($parts[0], 0, 1).(count($parts) > 1 ? mb_substr(end($parts), 0, 1) : ''));
    }
}
