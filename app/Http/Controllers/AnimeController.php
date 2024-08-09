<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\FavoriteAnimesRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Anime;
use App\Models\FavoriteAnime;
use App\Models\FolderAnime;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AnimeController extends Controller
{

    public function index(): View
    {
        $animes = Anime::query()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.anime.index')->with('animes', $animes);
    }

    public function show($slug): View
    {
        $anime = Cache::store('redis_animes')->remember('anime:'.$slug, 600, function () use ($slug) {
            return Anime::query()
                ->where('slug', $slug)
                ->with('type')
                ->with('country')
                ->with('studios')
                ->with('genres')
                ->firstOrFail();
        });

        $ratingUser = $anime->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $anime->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_anime_id');

        $foldersUser = FolderAnime::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->orderBy('id')
            ->get();

        return view('layouts.anime.show')
            ->with('anime', $anime)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser);
    }

    public function watch($slug): View
    {
        $anime = Cache::store('redis_animes')->remember('anime_watch:'.$slug, 600, function () use ($slug) {
            return Anime::query()
                ->where('slug', $slug)
                ->with('type')
                ->with('genres')
                ->firstOrFail();
        });

        $ratingUser = $anime->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $anime->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_anime_id');

        $foldersUser = FolderAnime::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->orderBy('id')
            ->get();

        $episodes = $anime->animeEpisodes()
            ->where('status', StatusEnum::PUBLISHED)
            ->orderBy('number')
            ->get();

        return view('layouts.anime.watch')
            ->with('anime', $anime)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser)
            ->with('episodes', $episodes);
    }

    public function rating(RatingRequest $request, Anime $anime): RedirectResponse
    {
        $anime->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

    public function favorite(FavoriteAnimesRequest $request, Anime $anime): RedirectResponse
    {
        $anime->favorites()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['folder_anime_id' => $request->input('folder')]
        );

        return redirect()->back();
    }

}
