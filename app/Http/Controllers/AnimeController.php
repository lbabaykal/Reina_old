<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Anime;
use App\Reina;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnimeController extends Controller
{

    public function show(Anime $anime): View
    {
        return view('layouts.anime.show')
            ->with('anime', $anime);
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
}
