<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public const CATEGORIES = [
        'wolbachia' => 'Nyamuk Wolbachia',
        'ovitrap' => 'Ember Ovitrap',
        'umum' => 'Program BiC-SMART',
    ];

    protected $fillable = ['question', 'answer', 'category', 'order_index', 'show_in_widget', 'is_active'];

    protected $casts = ['show_in_widget' => 'boolean', 'is_active' => 'boolean'];

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('order_index');
    }
}
