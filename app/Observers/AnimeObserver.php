<?php

namespace App\Observers;

use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class AnimeObserver
{

    public function created(Anime $anime): void
    {
        //
    }

    public function updated(Anime $anime): void
    {
        //
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
        $anime->ratings()->delete();
        Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
    }

    public function restored(Anime $anime): void
    {
        //
    }

    public function forceDeleted(Anime $anime): void
    {
        Storage::disk('anime_posters')->delete($anime->getOriginal('poster'));
        Storage::disk('anime_covers')->delete($anime->getOriginal('cover'));
    }
}
