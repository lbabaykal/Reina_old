<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FolderController extends Controller
{
    public function __invoke(): View
    {
        $foldersAnimes = auth()->user()
            ->favoriteAnimes()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total', 'favorite_animes.updated_at'])
            ->latest('favorite_animes.updated_at')
            ->limit(8)
            ->get();

        $foldersDoramas = auth()->user()
            ->favoriteDoramas()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total', 'favorite_doramas.updated_at'])
            ->latest('favorite_doramas.updated_at')
            ->limit(8)
            ->get();

        return view('layouts.folder.index')
            ->with('foldersAnimes', $foldersAnimes)
            ->with('foldersDoramas', $foldersDoramas);
    }

}
