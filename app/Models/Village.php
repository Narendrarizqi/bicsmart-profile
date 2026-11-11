<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['slug', 'code', 'name', 'district', 'description', 'order_index'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getLabelAttribute(): string
    {
        return "{$this->name} (Kec. {$this->district})";
    }
}
