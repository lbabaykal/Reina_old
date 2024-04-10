<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StudioRequest;
use App\Models\Studio;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudiosAdminController extends Controller
{

    public function index(): View
    {
        $studios = Studio::query()->select(['slug', 'title'])
            ->latest('id')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.studios.index')
            ->with('studios', $studios);
    }

    public function create(): View
    {
        return view('admin.studios.create');
    }

    public function store(StudioRequest $request): RedirectResponse
    {
        $studio = Studio::query()->create($request->validated());
        return redirect()
            ->route('admin.studios.index')
            ->with('message', "Студия {$studio->title} создана.");
    }

    public function edit(Studio $studio): View
    {
        return view('admin.studios.edit')
            ->with('studio', $studio);
    }

    public function update(StudioRequest $request, Studio $studio): RedirectResponse
    {
        $studio->update($request->validated());
        return redirect()
            ->route('admin.studios.index')
            ->with('message', "Студия {$studio->title} обновлена.");
    }

}
