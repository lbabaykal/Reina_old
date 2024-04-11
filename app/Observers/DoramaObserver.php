<?php

namespace App\Observers;

use App\Models\Dorama;
use Illuminate\Support\Facades\Storage;

class DoramaObserver
{

    public function created(Dorama $dorama): void
    {
        //
    }

    public function updated(Dorama $dorama): void
    {
        //
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
        Storage::disk('dorama_posters')->delete($dorama->getOriginal('poster'));
        Storage::disk('dorama_covers')->delete($dorama->getOriginal('cover'));
    }

    public function restored(Dorama $dorama): void
    {
        //
    }

    public function forceDeleted(Dorama $dorama): void
    {
        Storage::disk('dorama_posters')->delete($dorama->getOriginal('poster'));
        Storage::disk('dorama_covers')->delete($dorama->getOriginal('cover'));
    }
}
