<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderAnimesRequest;
use App\Models\FolderAnime;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AnimeFolderController extends Controller
{
    public function index(): View
    {
        $folders = auth()->user()
            ->foldersAnimesWithDefault()
            ->withCount('favoritesAnimesUser')
            ->orderBy('folder_animes.id')
            ->get();

        $animes = auth()->user()
            ->favoriteAnimes()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total', 'favorite_animes.updated_at'])
            ->latest('favorite_animes.updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FOLDERS)
            ->withQueryString();

        return view('layouts.folder.anime.index')
            ->with('animes', $animes)
            ->with('folders', $folders);
    }

    public function show(FolderAnime $folder): View|RedirectResponse
    {
        Gate::authorize('view', $folder);

        $folders = auth()->user()
            ->foldersAnimesWithDefault()
            ->withCount('favoritesAnimesUser')
            ->orderBy('folder_animes.id')
            ->get();

        $animes = auth()->user()
            ->favoriteAnimes()
            ->where('folder_anime_id', $folder->id)
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorite_animes.id')
            ->paginate(Reina::COUNT_ARTICLES_FOLDERS)
            ->withQueryString();

        return view('layouts.folder.anime.index')
            ->with('animes', $animes)
            ->with('folders', $folders);
    }

    public function create()
    {
        Gate::authorize('create', FolderAnime::class);
    }

    public function store(FolderAnimesRequest $request): RedirectResponse
    {
        $response = Gate::inspect('create', FolderAnime::class);

        if ($response->denied()) {
            return redirect()
                ->route('user.folders.animes.index')
                ->with('message', $response->message());
        }

        $folder = new FolderAnime();
        $folder->title = $request->input('title');
        $folder->user_id = auth()->id();
        $folder->save();

        return redirect()->route('user.folders.animes.index')
            ->with('message', "Папка {$folder->title} создана.");
    }

    public function edit(FolderAnime $folder): View
    {
        Gate::authorize('update', $folder);

        return view('layouts.folder.anime.edit')
            ->with('folder', $folder);
    }

    public function update(FolderAnimesRequest $request, FolderAnime $folder): RedirectResponse
    {
        Gate::authorize('update', $folder);

        $folder->title = $request->input('title');
        $folder->update();

        return redirect()->route('user.folders.animes.index')
            ->with('message', "Папка {$folder->title} изменана.");
    }

    public function destroy(FolderAnime $folder): RedirectResponse
    {
        Gate::authorize('delete', $folder);

        $folder->delete();

        return redirect()->route('user.folders.animes.index')
            ->with('message', "Папка {$folder->title} удалена.");
    }

}
