<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\CountryStoreRequest;
use App\Http\Requests\AdminPanel\CountryUpdateRequest;
use App\Models\Country;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountriesAdminController extends Controller
{

    public function index(): View
    {
        $countries = Country::query()->select(['slug', 'title_ru', 'title_en'])
            ->latest('id')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.countries.index')
            ->with('countries', $countries);
    }

    public function create(): View
    {
        return view('admin.countries.create');
    }

    public function store(CountryStoreRequest $request): RedirectResponse
    {
        $country = Country::query()->create($request->validated());
        return redirect()
            ->route('admin.countries.index')
            ->with('message', "Страна {$country->title_ru} создана.");
    }

    public function edit(Country $country): View
    {
        return view('admin.countries.edit')
            ->with('country', $country);
    }

    public function update(CountryUpdateRequest $request, Country $country): RedirectResponse
    {
        $country->update($request->validated());
        return redirect()
            ->route('admin.countries.index')
            ->with('message', "Страна {$country->title_ru} обновлена.");
    }

}
