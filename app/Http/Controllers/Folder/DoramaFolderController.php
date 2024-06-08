<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Dorama;
use App\Models\Folder;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoramaFolderController extends Controller
{

    public function index(): View
    {
        $folders = auth()->user()
            ->foldersWithDefault()
            ->applyFolderFilter(Dorama::class)
            ->withCount('favoritesUser')
            ->orderBy('folders.id')
            ->get();

        $doramas = auth()->user()
            ->favoriteDoramas()
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.folder.dorama.index')
            ->with('doramas', $doramas)
            ->with('folders', $folders);
    }

    public function show(Folder $folder): View
    {
        $folders = auth()->user()
            ->foldersWithDefault()
            ->applyFolderFilter(Dorama::class)
            ->withCount('favoritesUser')
            ->orderBy('folders.id')
            ->get();

        $doramas = auth()->user()
            ->favoriteDoramas()
            ->where('folder_id', $folder->id)
            ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
            ->latest('favorites.id')
            ->paginate(Reina::COUNT_ARTICLES_FULL)
            ->withQueryString();

        return view('layouts.folder.dorama.index')
            ->with('doramas', $doramas)
            ->with('folders', $folders);
    }

    public function create()
    {
        //
    }

    public function store(FolderRequest $request): RedirectResponse
    {

        $countFolder = auth()->user()->folders()->applyFolderFilter(Dorama::class)->count();

        if ($countFolder >= Reina::COUNT_FOLDERS) {
            return redirect()
                ->route('folders.doramas.index')
                ->with('message', 'Нельзя создавать больше ' . Reina::COUNT_FOLDERS . ' папок.');
        }

        $folder = new Folder();
        $folder->title = $request->input('title');
        $folder->user_id = auth()->id();
        $folder->folderable_type = Dorama::class;
        $folder->save();

        return redirect()->route('folders.doramas.index')
            ->with('message', "Папка {$folder->title} создана.");
    }

}
