<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\FavoriteRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Anime;
use App\Models\Folder;
use App\Models\User;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function show(Anime $anime): View
    {
        $ratingUser = $anime->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $anime->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_id');

        $foldersUser = Folder::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->applyFolderFilter(Anime::class)
            ->orderBy('id')
            ->get();

        return view('layouts.anime.show')
            ->with('anime', $anime)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser);
    }

    public function rating(RatingRequest $request, Anime $anime): RedirectResponse
    {
        $anime->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

    public function favorite(FavoriteRequest $request, Anime $anime): RedirectResponse
    {
        $anime->favorites()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['folder_id' => $request->input('folder')]
        );

        return redirect()->back();
    }
}
