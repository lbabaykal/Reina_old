<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'rating_type',
        'rating_id',
        'assessment',
    ];

    public function ratingable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRatedAnimes($query)
    {
        return $query->where('ratingable_type', Anime::class);
    }

    public function scopeRatedDoramas($query)
    {
        return $query->where('ratingable_type', Dorama::class);
    }
}
