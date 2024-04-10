<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Type;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TypeAdminController extends Controller
{

    public function index(): View
    {
        $types = Type::query()->select(['slug', 'title_ru', 'title_en'])
            ->latest('id')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.types.index')
            ->with('types', $types);
    }

    public function create(): View
    {
        return view('admin.types.create');
    }

    public function store(TypeRequest $request): RedirectResponse
    {
        $type = Type::query()->create($request->validated());
        return redirect()
            ->route('admin.types.index')
            ->with('message', "Тип {$type->title_ru} добавлен.");
    }

    public function edit(Type $type): View
    {
        return view('admin.types.edit')
            ->with('type', $type);
    }

    public function update(TypeRequest $request, Type $type): RedirectResponse
    {
        $type->update($request->validated());
        return redirect()
            ->route('admin.types.index')
            ->with('message', "Тип {$type->title_ru} обновлен.");
    }

}
