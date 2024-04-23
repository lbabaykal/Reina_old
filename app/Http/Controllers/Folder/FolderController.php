<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Anime;
use App\Models\Dorama;
use App\Models\Folder;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FolderController extends Controller
{
    public function index()
    {
        $foldersAnimes = auth()->user()
            ->favoriteAnimes()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->limit(8)
            ->get();

        $foldersDoramas = auth()->user()
            ->favoriteDoramas()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->limit(8)
            ->get();

        return view('layouts.folder.index')
            ->with('foldersAnimes', $foldersAnimes)
            ->with('foldersDoramas', $foldersDoramas);
    }

    public function edit(Folder $folder): View
    {
        return view('layouts.folder.edit')
            ->with('folder', $folder);
    }

    public function update(FolderRequest $request, Folder $folder)
    {
        $folder->title = $request->input('title');
        $folder->update();

        return match ($folder->folderable_type) {
            Anime::class => redirect()
                ->route('folders.animes.index')
                ->with('message', "Папка {$folder->title} изменана."),
            Dorama::class => redirect()
                ->route('folders.doramas.index')
                ->with('message', "Папка {$folder->title} изменана."),
            default => redirect()
                ->back()
                ->with('message', "Проблема изменения папки."),
        };
    }

    public function destroy(Folder $folder): RedirectResponse
    {
        $folder->delete();

        return match ($folder->folderable_type) {
            Anime::class => redirect()
                ->route('folders.animes.index')
                ->with('message', "Папка {$folder->title} удалена."),
            Dorama::class => redirect()
                ->route('folders.doramas.index')
                ->with('message', "Папка {$folder->title} удалена."),
            default => redirect()
                ->back()
                ->with('message', "Проблема удаления папки."),
        };
    }

}
