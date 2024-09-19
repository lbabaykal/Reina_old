<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Anime;
use App\Models\Dorama;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function addToAnime(RatingRequest $request, $animeSlug): RedirectResponse
    {
        $anime = Anime::query()->select(['id', 'slug'])
            ->where('slug', $animeSlug)
            ->firstOrFail();

        $anime->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

    public function removeToAnime($animeSlug): RedirectResponse
    {
        $anime = Anime::query()->select(['id', 'slug'])
            ->where('slug', $animeSlug)
            ->firstOrFail();

//        $anime->favorites()
//            ->where('user_id', auth()->id())
//            ->delete();

        return redirect()->back();
    }

    public function addToDorama(RatingRequest $request, $doramaSlug): RedirectResponse
    {
        $dorama = Dorama::query()->select(['id', 'slug'])
            ->where('slug', $doramaSlug)
            ->firstOrFail();

        $dorama->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

    public function removeToDorama($doramaSlug): RedirectResponse
    {
        $dorama = Dorama::query()->select(['id', 'slug'])
            ->where('slug', $doramaSlug)
            ->firstOrFail();

//        $dorama->favorites()
//            ->where('user_id', auth()->id())
//            ->delete();

        return redirect()->back();
    }
}
