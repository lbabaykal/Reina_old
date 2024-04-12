<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\RatingRequest;
use App\Models\Anime;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnimeController extends Controller
{

    public function show(Anime $anime): View
    {
        $ratingUser = $anime->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        return view('layouts.anime.show')
            ->with('anime', $anime)
            ->with('ratingUser', $ratingUser);
    }

    public function index(): View
    {
        $animes = Anime::query()->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.anime.index')->with('animes', $animes);
    }

    public function rating(RatingRequest $request, Anime $anime): RedirectResponse
    {
        $anime->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

}
