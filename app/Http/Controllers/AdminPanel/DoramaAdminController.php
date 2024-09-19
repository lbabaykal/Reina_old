<?php

namespace App\Http\Controllers\AdminPanel;

use App\Enums\AgeRatingEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\DoramaStoreRequest;
use App\Http\Requests\AdminPanel\DoramaUpdateRequest;
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
        $doramas = Dorama::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'episodes_released', 'episodes_total'])
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

    public function store(DoramaStoreRequest $request, DoramaServices $doramaServices): RedirectResponse
    {
        return $doramaServices->store($request);
    }

    public function edit($doramaSlug): View
    {
        $dorama = Dorama::query()
            ->withoutGlobalScopes()
            ->where('slug', $doramaSlug)
            ->firstOrFail();

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

    public function update(Request $request, $doramaSlug, DoramaServices $doramaServices): RedirectResponse
    {
        $dorama = Dorama::query()
            ->withoutGlobalScopes()
            ->where('slug', $doramaSlug)
            ->firstOrFail();
        $request->validate((new DoramaUpdateRequest())->rules($dorama->id), (new DoramaUpdateRequest())->messages());

        return $doramaServices->update($request, $dorama);
    }

    public function restore($doramaSlug): RedirectResponse
    {
        $dorama = Dorama::withTrashed()
            ->withoutGlobalScopes()
            ->where('slug', $doramaSlug)
            ->firstOrFail();
        $dorama->restore();

        return redirect()->route('admin.dorama.index')->with('message', "Дорама {$dorama->title_ru} восстановлена.");
    }

    public function draft(): View
    {
        $doramas = Dorama::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
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
        $doramas = Dorama::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
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
        $doramas = Dorama::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::ARCHIVE)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.index')->with('doramas', $doramas);
    }

    public function deleted(): View
    {
        $doramas = Dorama::query()
            ->onlyTrashed()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.dorama.deleted')->with('doramas', $doramas);
    }

    public function regenerateSlug($doramaSlug)
    {
        $dorama = Dorama::query()
            ->withoutGlobalScopes()
            ->where('slug', $doramaSlug)
            ->firstOrFail();

        $dorama->generateSlug();
        $dorama->timestamps = false;
        $dorama->update();

        return redirect()->route('admin.dorama.index')->with('message', "Для аниме {$dorama->title_ru} перегенерирован слаг.");
    }
}
