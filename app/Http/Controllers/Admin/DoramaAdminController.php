<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AgeRatingEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoramaRequest;
use App\Models\Country;
use App\Models\Dorama;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Reina;
use App\Services\DoramaServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoramaAdminController extends Controller
{

    public function index(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id'])
            ->with('type')
            ->with('country')
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function create(): View
    {
        $types = Type::all();
        $genres = Genre::all();
        $studios = Studio::all();
        $countries = Country::all();
        $age_ratings = AgeRatingEnum::cases();
        $statuses = StatusEnum::cases();

        return view('admin.dorama.create')
            ->with('types', $types)
            ->with('genres', $genres)
            ->with('studios', $studios)
            ->with('countries', $countries)
            ->with('age_ratings', $age_ratings)
            ->with('statuses', $statuses);
    }

    public function store(DoramaRequest $request, DoramaServices $doramaServices): RedirectResponse
    {
        return $doramaServices->store($request);
    }

    public function edit(Dorama $dorama): View
    {
        $types = Type::all();
        $genres = Genre::all();
        $studios = Studio::all();
        $countries = Country::all();
        $age_ratings = AgeRatingEnum::cases();
        $statuses = StatusEnum::cases();

        return view('admin.dorama.edit')
            ->with('dorama', $dorama)
            ->with('types', $types)
            ->with('genres', $genres)
            ->with('studios', $studios)
            ->with('countries', $countries)
            ->with('age_ratings', $age_ratings)
            ->with('statuses', $statuses);
    }

    public function update(DoramaRequest $request, Dorama $dorama, DoramaServices $doramaServices): RedirectResponse
    {
        return $doramaServices->update($request, $dorama);
    }

    public function draft(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::DRAFT)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function published(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function archive(): View
    {
        $doramas = Dorama::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::ARCHIVE)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }
}
