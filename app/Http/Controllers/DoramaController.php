<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Dorama;
use App\Reina;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoramaController extends Controller
{

    public function show(Dorama $dorama): View
    {
        return view('layouts.dorama.show')
            ->with('dorama', $dorama);
    }

    public function index(): View
    {
        $dorams = Dorama::query()->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.dorama.index')->with('dorams', $dorams);
    }
}
