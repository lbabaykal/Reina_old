<?php

namespace App\Models;

use App\Observers\DoramaObserver;
use App\Traits\AnimeAndDoramTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([DoramaObserver::class])]
class Dorama extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AnimeAndDoramTrait;

    protected $fillable = [
        'slug',
        'poster',
        'cover',
        'title_org',
        'title_ru',
        'title_en',
        'type_id',
        'genre_id',
        'studio_id',
        'country_id',
        'age_rating',
        'episodes_released',
        'episodes_total',
        'duration',
        'release',
        'description',
        'status',
        'rating',
        'count_assessments',
        'is_comment',
        'is_rating',
    ];

    public $timestamps = false;

    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteDorama::class);
    }

    public function doramaEpisodes(): HasMany
    {
        return $this->hasMany(DoramaEpisode::class);
    }

}
