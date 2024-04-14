<?php

namespace App\Observers;

use App\Models\Anime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AnimeObserver
{

    public function created(Anime $anime): void
    {
        Cache::forget('main_animes');
    }

    public function updated(Anime $anime): void
    {
        Cache::forget('main_animes');
    }

    public function updating(Anime $anime): void
    {
        if ($anime->isDirty('poster') && $anime->getOriginal('poster')) {
            Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        }

        if ($anime->isDirty('cover') && $anime->getOriginal('cover')) {
            Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
        }
    }

    public function deleted(Anime $anime): void
    {
        Cache::forget('main_animes');
    }

    public function restored(Anime $anime): void
    {
        Cache::forget('main_animes');
    }

    public function forceDeleted(Anime $anime): void
    {
        $anime->ratings()->delete();
        $anime->genres()->detach();
        $anime->studios()->detach();

        if ($anime->getOriginal('poster') !== null) {
            Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        }

        if ($anime->getOriginal('cover') !== null) {
            Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
        }

        Cache::forget('main_animes');
    }
}
