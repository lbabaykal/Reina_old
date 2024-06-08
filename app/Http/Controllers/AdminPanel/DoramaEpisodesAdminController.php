<?php

namespace App\Http\Controllers\AdminPanel;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\EpisodeStoreRequest;
use App\Http\Requests\AdminPanel\EpisodeUpdateRequest;
use App\Models\Dorama;
use App\Models\DoramaEpisode;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoramaEpisodesAdminController extends Controller
{
    public function index(Dorama $dorama): View
    {
        $episodes = $dorama->doramaEpisodes()
            ->orderBy('number')
            ->paginate(Reina::COUNT_ADMIN_EPISODES)
            ->withQueryString();

        return view('admin.dorama.episodes.index')
            ->with('dorama', $dorama)
            ->with('episodes', $episodes);
    }

    public function create(Dorama $dorama): View
    {
        $statuses = StatusEnum::cases();

        return view('admin.dorama.episodes.create')
            ->with('statuses', $statuses)
            ->with('dorama', $dorama);
    }

    public function store(Dorama $dorama, EpisodeStoreRequest $request): RedirectResponse
    {
        $episode = $dorama->doramaEpisodes()->create($request->validated());

        return redirect()
            ->route('admin.dorama.episodes.index', $dorama)
            ->with('message', "Эпизод {$episode->title_ru} добавлен.");
    }

    public function edit(Dorama $dorama, DoramaEpisode $episode): View
    {
        $statuses = StatusEnum::cases();

        return view('admin.dorama.episodes.edit')
            ->with('statuses', $statuses)
            ->with('dorama', $dorama)
            ->with('episode', $episode);
    }

    public function update(Dorama $dorama, EpisodeUpdateRequest $request, DoramaEpisode $episode): RedirectResponse
    {
        $episode->update($request->validated());

        return redirect()
            ->route('admin.dorama.episodes.index', $dorama)
            ->with('message', "Эпизод {$episode->title_ru} обновлен.");
    }

    public function destroy(Dorama $dorama, DoramaEpisode $episode): RedirectResponse
    {
        $episode->delete();

        return redirect()
            ->route('admin.dorama.episodes.index', $dorama)
            ->with('message', "Эпизод {$episode->title_ru} удалён.");
    }
}
