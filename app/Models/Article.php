<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    public const CATEGORIES = [
        'berita' => 'Berita Kegiatan',
        'rilis' => 'Rilis Media',
        'edukasi' => 'Edukasi DBD & Wolbachia',
    ];

    protected $fillable = [
        'title', 'slug', 'category', 'summary', 'content', 'featured_image', 'gallery',
        'author_id', 'status', 'published_at', 'is_featured',
    ];

    protected $casts = [
        'gallery' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Article $a) {
            $a->slug = $a->slug ?: Str::slug($a->title);
            if ($a->status === 'published' && ! $a->published_at) {
                $a->published_at = now();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'published')->where('published_at', '<=', now())->latest('published_at');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::disk('public')->url($this->featured_image) : null;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    public function getExcerptAttribute(): string
    {
        return $this->summary ?: Str::limit(strip_tags($this->content), 160);
    }

    public function getReadingMinutesAttribute(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->content)) / 200));
    }
}
