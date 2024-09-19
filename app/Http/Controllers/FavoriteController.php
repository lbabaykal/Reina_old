<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteAnimesRequest;
use App\Http\Requests\FavoriteDoramasRequest;
use App\Models\Anime;
use App\Models\Dorama;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    public function addToAnime(FavoriteAnimesRequest $request, $animeSlug): RedirectResponse
    {
        $anime = Anime::query()->select(['id', 'slug'])
            ->where('slug', $animeSlug)
            ->firstOrFail();

        $anime->favorites()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['folder_anime_id' => $request->input('folder')]
        );

        return redirect()->back();
    }

    public function removeToAnime($animeSlug): RedirectResponse
    {
        $anime = Anime::query()->select(['id', 'slug'])
            ->where('slug', $animeSlug)
            ->firstOrFail();

        $anime->favorites()
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->back();
    }

    public function addToDorama(FavoriteDoramasRequest $request, $doramaSlug): RedirectResponse
    {
        $dorama = Dorama::query()->select(['id', 'slug'])
            ->where('slug', $doramaSlug)
            ->firstOrFail();

        $dorama->favorites()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['folder_dorama_id' => $request->input('folder')]
        );

        return redirect()->back();
    }

    public function removeToDorama($doramaSlug): RedirectResponse
    {
        $dorama = Dorama::query()->select(['id', 'slug'])
            ->where('slug', $doramaSlug)
            ->firstOrFail();

        $dorama->favorites()
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->back();
    }
}
