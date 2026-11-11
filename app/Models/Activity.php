<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Dokumentasi kegiatan harian.
 */
class Activity extends Model
{
    public const CATEGORIES = [
        'wp1' => 'WP1 · Kesiapan Sosial',
        'wp3' => 'WP1.5/WP3 · Surveilans Ovitrap',
        'sosialisasi' => 'Sosialisasi Warga',
        'pelatihan' => 'Pelatihan',
        'rapat' => 'Rapat Koordinasi',
    ];

    /** Warna badge per kategori (kelas Tailwind). */
    public const CATEGORY_COLORS = [
        'wp1' => 'bg-navy-50 text-navy-700 ring-navy-200',
        'wp3' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
        'sosialisasi' => 'bg-cyan-50 text-cyan-700 ring-cyan-200',
        'pelatihan' => 'bg-amber-50 text-amber-700 ring-amber-200',
        'rapat' => 'bg-slate-100 text-slate-700 ring-slate-200',
    ];

    protected $fillable = [
        'title', 'slug', 'activity_date', 'category', 'village_id', 'location',
        'description', 'photos', 'author_id', 'status',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'photos' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Activity $a) {
            if (! $a->slug) {
                $base = Str::slug($a->activity_date?->format('Y-m-d').' '.$a->title);
                $slug = $base;
                $i = 2;
                while (static::where('slug', $slug)->where('id', '!=', $a->id)->exists()) {
                    $slug = $base.'-'.$i++;
                }
                $a->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'published')->latest('activity_date')->latest('id');
    }

    public function getPhotoUrlsAttribute(): array
    {
        return collect($this->photos ?? [])->map(fn ($p) => Storage::disk('public')->url($p))->all();
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->photo_urls[0] ?? null;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    public function getCategoryColorAttribute(): string
    {
        return self::CATEGORY_COLORS[$this->category] ?? self::CATEGORY_COLORS['rapat'];
    }

    public function getPlaceLabelAttribute(): ?string
    {
        return $this->village ? "Desa {$this->village->name}" : $this->location;
    }
}
