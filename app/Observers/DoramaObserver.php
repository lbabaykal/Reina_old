<?php

namespace App\Observers;

use App\Models\Dorama;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DoramaObserver
{

    public function created(Dorama $dorama): void
    {
        Cache::forget('main_doramas');
    }

    public function updated(Dorama $dorama): void
    {
        Cache::forget('main_doramas');
    }

    public function updating(Dorama $dorama): void
    {
        if ($dorama->isDirty('poster') && $dorama->getOriginal('poster')) {
            Storage::disk('dorama_posters')->delete($dorama->getOriginal('poster'));
        }

        if ($dorama->isDirty('cover') && $dorama->getOriginal('cover')) {
            Storage::disk('dorama_covers')->delete($dorama->getOriginal('cover'));
        }
    }

    public function deleted(Dorama $dorama): void
    {
        Cache::forget('main_doramas');
    }

    public function restored(Dorama $dorama): void
    {
        Cache::forget('main_doramas');
    }

    public function forceDeleted(Dorama $dorama): void
    {
        $dorama->ratings()->delete();
        $dorama->genres()->detach();
        $dorama->studios()->detach();

        if ($dorama->getOriginal('poster') !== null) {
            Storage::disk('dorama_posters')->delete($dorama->getOriginal('poster'));
        }

        if ($dorama->getOriginal('cover') !== null) {
            Storage::disk('dorama_covers')->delete($dorama->getOriginal('cover'));
        }

        Cache::forget('main_doramas');
    }
}
