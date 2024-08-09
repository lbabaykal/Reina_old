<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderDoramasRequest;
use App\Models\FolderDorama;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DoramaFolderController extends Controller
{
    public function index(): View
    {
        $folders = auth()->user()
            ->foldersDoramasWithDefault()
            ->withCount('favoritesDoramasUser')
            ->orderBy('folder_doramas.id')
            ->get();

        $doramas = auth()->user()
            ->favoriteDoramas()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total', 'favorite_doramas.updated_at'])
            ->latest('favorite_doramas.updated_at')
            ->paginate(Reina::COUNT_ARTICLES_FOLDERS)
            ->withQueryString();

        return view('layouts.folder.dorama.index')
            ->with('doramas', $doramas)
            ->with('folders', $folders);
    }

    public function show(FolderDorama $folder): View|RedirectResponse
    {
        Gate::authorize('view', $folder);

        $folders = auth()->user()
            ->foldersDoramasWithDefault()
            ->withCount('favoritesDoramasUser')
            ->orderBy('folder_doramas.id')
            ->get();

        $doramas = auth()->user()
            ->favoriteDoramas()
            ->where('folder_dorama_id', $folder->id)
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorite_doramas.id')
            ->paginate(Reina::COUNT_ARTICLES_FOLDERS)
            ->withQueryString();

        return view('layouts.folder.dorama.index')
            ->with('doramas', $doramas)
            ->with('folders', $folders);
    }

    public function create()
    {
        Gate::authorize('create', FolderDorama::class);
    }

    public function store(FolderDoramasRequest $request): RedirectResponse
    {
        $response = Gate::inspect('create', FolderDorama::class);

        if ($response->denied()) {
            return redirect()
                ->route('user.folders.doramas.index')
                ->with('message', $response->message());
        }

        $folder = new FolderDorama();
        $folder->title = $request->input('title');
        $folder->user_id = auth()->id();
        $folder->save();

        return redirect()->route('user.folders.doramas.index')
            ->with('message', "Папка {$folder->title} создана.");
    }

    public function edit(FolderDorama $folder): View
    {
        Gate::authorize('update', $folder);

        return view('layouts.folder.dorama.edit')
            ->with('folder', $folder);
    }

    public function update(FolderDoramasRequest $request, FolderDorama $folder): RedirectResponse
    {
        Gate::authorize('update', $folder);

        $folder->title = $request->input('title');
        $folder->update();

        return redirect()->route('user.folders.doramas.index')
            ->with('message', "Папка {$folder->title} изменана.");
    }

    public function destroy(FolderDorama $folder): RedirectResponse
    {
        Gate::authorize('delete', $folder);

        $folder->delete();

        return redirect()->route('user.folders.doramas.index')
            ->with('message', "Папка {$folder->title} удалена.");
    }

}
