<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Psr\SimpleCache\InvalidArgumentException;

class AnimeObserver
{

    public function created(Anime $anime): void
    {
        if ($anime->status === StatusEnum::PUBLISHED->value) {
            Cache::store('redis_animes')->forget('main_animes');
        }
    }

    public function updating(Anime $anime): void
    {
        if ($anime->isDirty() && $anime->status === StatusEnum::PUBLISHED->value) {
            $anime->timestamps = true;
        }

        if ($anime->isDirty('poster') && $anime->getOriginal('poster')) {
            Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        }

        if ($anime->isDirty('cover') && $anime->getOriginal('cover')) {
            Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
        }
    }

    public function updated(Anime $anime): void
    {
        if ($anime->isDirty() && $anime->status === StatusEnum::PUBLISHED->value) {
            Cache::store('redis_animes')->forget('main_animes');
        }

        if ($anime->getOriginal('status') === StatusEnum::PUBLISHED->value
            || $anime->getAttribute('status') === StatusEnum::PUBLISHED->value) {
            $this->forgetCacheMainAnime($anime);
        }
    }

    public function saving(Anime $anime): void
    {
        //
    }

    public function saved(Anime $anime): void
    {
        //
    }

    public function deleted(Anime $anime): void
    {
        $this->forgetCacheMainAnime($anime);
    }

    public function restored(Anime $anime): void
    {
        //
    }

    public function forceDeleted(Anime $anime): void
    {
        $anime->ratings()->delete();
        $anime->favorites()->delete();

        $anime->animeEpisodes()->delete();

        $anime->genres()->detach();
        $anime->studios()->detach();

        if ($anime->getOriginal('poster') !== null) {
            Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        }

        if ($anime->getOriginal('cover') !== null) {
            Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
        }

        $this->forgetCacheAnime($anime);
        $this->forgetCacheMainAnime($anime);
    }

    public function retrieved(Anime $anime): void
    {
        //
    }

    public function forgetCacheMainAnime(Anime $anime): void
    {
        if (Cache::store('redis_animes')->has('main_animes')
            && Cache::store('redis_animes')->get('main_animes')->contains('id', $anime->id)) {
            Cache::store('redis_animes')->forget('main_animes');
        }
    }

    public function forgetCacheAnime(Anime $anime): void
    {
        Cache::store('redis_animes')->forget('anime:' . $anime->slug);
    }
}
