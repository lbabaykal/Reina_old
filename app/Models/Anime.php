<?php

namespace App\Models;

use App\Traits\AnimeAndDoramTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
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
        'user_id',
        'status',
        'rating',
        'count_assessments',
        'is_comment',
        'is_rating',
    ];

}
