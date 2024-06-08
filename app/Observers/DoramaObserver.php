<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Dorama;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DoramaObserver
{

    public function created(Dorama $dorama): void
    {
        if ($dorama->status === StatusEnum::PUBLISHED->value) {
            Cache::forget('main_doramas');
        }
    }

    public function updating(Dorama $dorama): void
    {
        if ($dorama->isDirty() && $dorama->status === StatusEnum::PUBLISHED->value) {
            $dorama->timestamps = true;
        }

        if ($dorama->isDirty('poster') && $dorama->getOriginal('poster')) {
            Storage::disk('dorama_posters')->delete($dorama->getOriginal('poster'));
        }

        if ($dorama->isDirty('cover') && $dorama->getOriginal('cover')) {
            Storage::disk('dorama_covers')->delete($dorama->getOriginal('cover'));
        }
    }

    public function updated(Dorama $dorama): void
    {
        if ($dorama->isDirty() && $dorama->status === StatusEnum::PUBLISHED->value) {
            Cache::forget('main_doramas');
        }

        if ($dorama->getOriginal('status') === StatusEnum::PUBLISHED->value || $dorama->getAttribute('status') === StatusEnum::PUBLISHED->value) {
            $this->forgetCacheMainDorama($dorama);
        }
    }

    public function saving(Dorama $dorama): void
    {
        //
    }

    public function saved(Dorama $dorama): void
    {
        //
    }

    public function deleted(Dorama $dorama): void
    {
        $this->forgetCacheMainDorama($dorama);
    }

    public function restored(Dorama $dorama): void
    {
        //
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

        $this->forgetCacheMainDorama($dorama);
    }

    public function retrieved(Dorama $dorama): void
    {
        //
    }

    public function forgetCacheMainDorama(Dorama $dorama): void
    {
        if (Cache::has('main_doramas') && Cache::get('main_doramas')->contains('id', $dorama->id)) {
            Cache::forget('main_doramas');
        }
    }
}
