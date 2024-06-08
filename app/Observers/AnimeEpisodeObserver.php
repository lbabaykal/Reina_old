<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Anime;
use App\Models\AnimeEpisode;
use Illuminate\Support\Facades\Cache;

class AnimeEpisodeObserver
{

    public function created(AnimeEpisode $animeEpisode): void
    {
        if ($animeEpisode->status === StatusEnum::PUBLISHED->value) {
            $this->updateFieldAndForgetCache($animeEpisode);
        }
    }

    public function updating(AnimeEpisode $animeEpisode): void
    {
        //
    }

    public function updated(AnimeEpisode $animeEpisode): void
    {
        if ($animeEpisode->isDirty('status')
            && ($animeEpisode->getOriginal('status') === StatusEnum::PUBLISHED->value
                || $animeEpisode->getAttribute('status') === StatusEnum::PUBLISHED->value)
        ) {
            $this->updateFieldAndForgetCache($animeEpisode);
        }
    }

    public function saving(AnimeEpisode $animeEpisode): void
    {
        //
    }

    public function saved(AnimeEpisode $animeEpisode): void
    {
        //
    }

    public function deleted(AnimeEpisode $animeEpisode): void
    {
        if ($animeEpisode->status === StatusEnum::PUBLISHED->value) {
            $this->updateFieldAndForgetCache($animeEpisode);
        }
    }

    public function updateFieldAndForgetCache(AnimeEpisode $animeEpisode): void
    {
        $this->updateAnimeFieldEpisodesReleased($animeEpisode);
        $this->forgetCacheMainAnime($animeEpisode);
    }

    public function updateAnimeFieldEpisodesReleased(AnimeEpisode $animeEpisode): void
    {
        $animeEpisode->anime()->update([
            'episodes_released' => Anime::query()
                ->find($animeEpisode->anime->id)
                ->animeEpisodes()
                ->where('status', StatusEnum::PUBLISHED)
                ->count(),
            'updated_at' => now()
        ]);
    }

    public function forgetCacheMainAnime(AnimeEpisode $animeEpisode): void
    {
        if (Cache::has('main_animes') && Cache::get('main_animes')->contains('id', $animeEpisode->anime->id)) {
            Cache::forget('main_animes');
        }
    }
}
