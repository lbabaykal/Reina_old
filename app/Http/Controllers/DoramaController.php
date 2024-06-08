<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\FavoriteRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Dorama;
use App\Models\Folder;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoramaController extends Controller
{

    public function index(): View
    {
        $dorams = Dorama::query()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.dorama.index')->with('dorams', $dorams);
    }

    public function show(Dorama $dorama): View
    {
        $ratingUser = $dorama->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $dorama->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_id');

        $foldersUser = Folder::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->applyFolderFilter(Dorama::class)
            ->orderBy('id')
            ->get();

        return view('layouts.dorama.show')
            ->with('dorama', $dorama)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser);
    }

    public function rating(RatingRequest $request, Dorama $dorama): RedirectResponse
    {
        $dorama->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['assessment' => $request->input('assessment')]
        );

        return redirect()->back();
    }

    public function favorite(FavoriteRequest $request, Dorama $dorama): RedirectResponse
    {
        $dorama->favorites()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['folder_id' => $request->input('folder')]
        );

        return redirect()->back();
    }

    public function watch(Dorama $dorama): View
    {
        $ratingUser = $dorama->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $dorama->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_id');

        $foldersUser = Folder::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->applyFolderFilter(Dorama::class)
            ->orderBy('id')
            ->get();

        $episodes = $dorama->doramaEpisodes()
            ->where('status', StatusEnum::PUBLISHED)
            ->orderBy('number')
            ->get();

        return view('layouts.dorama.watch')
            ->with('dorama', $dorama)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser)
            ->with('episodes', $episodes);
    }

}
