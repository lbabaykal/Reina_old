<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Anime;
use App\Models\Dorama;
use App\Reina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MainController extends Controller
{
    public function __invoke(): View
    {
        $animes = Cache::rememberForever('main_animes', function () {
            return Anime::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->where('status', StatusEnum::PUBLISHED)
                ->limit(Reina::COUNT_ARTICLES_MAIN)
                ->latest('updated_at')
                ->get();
        });

        $doramas = Cache::rememberForever('main_doramas', function () {
            return Dorama::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->where('status', StatusEnum::PUBLISHED)
                ->limit(Reina::COUNT_ARTICLES_MAIN)
                ->latest('updated_at')
                ->get();
        });

        return view('layouts.main')
            ->with('animes', $animes)
            ->with('doramas', $doramas);
    }
}
