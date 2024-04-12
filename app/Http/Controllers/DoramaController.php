<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\RatingRequest;
use App\Models\Dorama;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoramaController extends Controller
{

    public function show(Dorama $dorama): View
    {
        $ratingUser = $dorama->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        return view('layouts.dorama.show')
            ->with('dorama', $dorama)
            ->with('ratingUser', $ratingUser);
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

    public function rating(RatingRequest $request, Dorama $dorama): RedirectResponse
    {
        $dorama->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }
}
