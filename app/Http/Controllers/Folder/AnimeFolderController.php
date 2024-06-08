<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Anime;
use App\Models\Folder;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnimeFolderController extends Controller
{

    public function index(): View
    {
        $folders = auth()->user()
            ->foldersWithDefault()
            ->applyFolderFilter(Anime::class)
            ->withCount('favoritesUser')
            ->orderBy('folders.id')
            ->get();

        $animes = auth()->user()
            ->favoriteAnimes()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.folder.anime.index')
            ->with('animes', $animes)
            ->with('folders', $folders);
    }

    public function show(Folder $folder): View
    {
        $folders = auth()->user()
            ->foldersWithDefault()
            ->applyFolderFilter(Anime::class)
            ->withCount('favoritesUser')
            ->orderBy('folders.id')
            ->get();

        $animes = auth()->user()
            ->favoriteAnimes()
            ->where('folder_id', $folder->id)
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.folder.anime.index')
            ->with('animes', $animes)
            ->with('folders', $folders);
    }

    public function create()
    {
        //
    }

    public function store(FolderRequest $request): RedirectResponse
    {

        $countFolder = auth()->user()->folders()->applyFolderFilter(Anime::class)->count();

        if ($countFolder >= Reina::COUNT_FOLDERS) {
            return redirect()
                ->route('folders.animes.index')
                ->with('message', 'Нельзя создавать больше ' . Reina::COUNT_FOLDERS . ' папок.');
        }

        $folder = new Folder();
        $folder->title = $request->input('title');
        $folder->user_id = auth()->id();
        $folder->folderable_type = Anime::class;
        $folder->save();

        return redirect()->route('folders.animes.index')
            ->with('message', "Папка {$folder->title} создана.");
    }

}
