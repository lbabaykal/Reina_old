<?php

namespace App\Http\Controllers\AdminPanel;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\EpisodeStoreRequest;
use App\Http\Requests\AdminPanel\EpisodeUpdateRequest;
use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnimeEpisodesAdminController extends Controller
{

    public function index(Anime $anime): View
    {
        $episodes = $anime->animeEpisodes()
            ->orderBy('number')
            ->paginate(Reina::COUNT_ADMIN_EPISODES)
            ->withQueryString();

        return view('admin.anime.episodes.index')
            ->with('anime', $anime)
            ->with('episodes', $episodes);
    }

    public function create(Anime $anime): View
    {
        $statuses = StatusEnum::cases();

        return view('admin.anime.episodes.create')
            ->with('statuses', $statuses)
            ->with('anime', $anime);
    }

    public function store(Anime $anime, EpisodeStoreRequest $request): RedirectResponse
    {
        $episode = $anime->animeEpisodes()->create($request->validated());

        return redirect()
            ->route('admin.anime.episodes.index', $anime)
            ->with('message', "Эпизод {$episode->title_ru} добавлен.");
    }

    public function edit(Anime $anime, AnimeEpisode $episode): View
    {
        $statuses = StatusEnum::cases();

        return view('admin.anime.episodes.edit')
            ->with('statuses', $statuses)
            ->with('anime', $anime)
            ->with('episode', $episode);
    }

    public function update(Anime $anime, EpisodeUpdateRequest $request, AnimeEpisode $episode): RedirectResponse
    {
        $episode->update($request->validated());

        return redirect()
            ->route('admin.anime.episodes.index', $anime)
            ->with('message', "Эпизод {$episode->title_ru} обновлен.");
    }

    public function destroy(Anime $anime, AnimeEpisode $episode): RedirectResponse
    {
        $episode->delete();

        return redirect()
            ->route('admin.anime.episodes.index', $anime)
            ->with('message', "Эпизод {$episode->title_ru} удалён.");
    }
}
