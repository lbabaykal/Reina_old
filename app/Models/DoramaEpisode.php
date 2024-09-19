<?php

namespace App\Models;

use App\Observers\Dorama\DoramaEpisodeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([DoramaEpisodeObserver::class])]
class DoramaEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'dorama_id',
        'title_org',
        'title_ru',
        'title_en',
        'status',
        'note',
        'release_date',
    ];

    public function dorama(): BelongsTo
    {
        return $this->belongsTo(Dorama::class);
    }
}
