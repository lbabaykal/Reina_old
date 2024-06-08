<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Dorama;
use App\Models\DoramaEpisode;
use Illuminate\Support\Facades\Cache;

class DoramaEpisodeObserver
{

    public function created(DoramaEpisode $doramaEpisode): void
    {
        if ($doramaEpisode->status === StatusEnum::PUBLISHED->value) {
            $this->updateFieldAndForgetCache($doramaEpisode);
        }
    }

    public function updating(DoramaEpisode $doramaEpisode): void
    {
        //
    }

    public function updated(DoramaEpisode $doramaEpisode): void
    {
        if ($doramaEpisode->isDirty('status')
            && ($doramaEpisode->getOriginal('status') === StatusEnum::PUBLISHED->value
                || $doramaEpisode->getAttribute('status') === StatusEnum::PUBLISHED->value)
        ) {
            $this->updateFieldAndForgetCache($doramaEpisode);
        }
    }

    public function saving(DoramaEpisode $doramaEpisode): void
    {
        //
    }

    public function saved(DoramaEpisode $doramaEpisode): void
    {
        //
    }

    public function deleted(DoramaEpisode $doramaEpisode): void
    {
        if ($doramaEpisode->status === StatusEnum::PUBLISHED->value) {
            $this->updateFieldAndForgetCache($doramaEpisode);
        }
    }

    public function updateFieldAndForgetCache(DoramaEpisode $doramaEpisode): void
    {
        $this->updateDoramaFieldEpisodesReleased($doramaEpisode);
        $this->forgetCacheMainDorama($doramaEpisode);
    }

    public function updateDoramaFieldEpisodesReleased(DoramaEpisode $doramaEpisode): void
    {
        $doramaEpisode->dorama()->update([
            'episodes_released' => Dorama::query()
                ->find($doramaEpisode->dorama->id)
                ->doramaEpisodes()
                ->where('status', StatusEnum::PUBLISHED)
                ->count(),
            'updated_at' => now()
        ]);
    }

    public function forgetCacheMainDorama(DoramaEpisode $doramaEpisode): void
    {
        if (Cache::has('main_doramas') && Cache::get('main_doramas')->contains('id', $doramaEpisode->dorama->id)) {
            Cache::forget('main_doramas');
        }
    }
}
