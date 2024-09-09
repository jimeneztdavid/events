<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch(Builder $query, $search)
    {
        $query->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%");
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
