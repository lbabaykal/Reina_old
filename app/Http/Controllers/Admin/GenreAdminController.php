<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreAdminController extends Controller
{

    public function index(): View
    {
        $genres = Genre::query()->select(['slug', 'title_ru', 'title_en'])
            ->latest('id')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.genres.index')
            ->with('genres', $genres);
    }

    public function create(): View
    {
        return view('admin.genres.create');
    }

    public function store(GenreRequest $request): RedirectResponse
    {
        $genre = Genre::query()->create($request->validated());
        return redirect()
            ->route('admin.genres.index')
            ->with('message', "Жанр {$genre->title_ru} добавлен.");
    }

    public function edit(Genre $genre): View
    {
        return view('admin.genres.edit')
            ->with('genre', $genre);
    }

    public function update(GenreRequest $request, Genre $genre): RedirectResponse
    {
        $genre->update($request->validated());
        return redirect()
            ->route('admin.genres.index')
            ->with('message', "Жанр {$genre->title_ru} обновлен.");
    }

}
