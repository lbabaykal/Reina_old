<?php

namespace App\Models;

use App\Observers\Anime\AnimeEpisodeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([AnimeEpisodeObserver::class])]
class AnimeEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'anime_id',
        'title_org',
        'title_ru',
        'title_en',
        'status',
        'note',
        'release_date',
    ];

    public function anime(): BelongsTo
    {
        return $this->belongsTo(Anime::class);
    }

}
