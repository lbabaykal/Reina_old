<?php

namespace App\Http\Controllers\AdminPanel;

use App\Enums\AgeRatingEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\AnimeStoreRequest;
use App\Http\Requests\AdminPanel\AnimeUpdateRequest;
use App\Models\Anime;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Reina;
use App\Services\AnimeServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AnimeAdminController extends Controller
{
    public function index(): View
    {
        $animes = Anime::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'episodes_released', 'episodes_total', 'updated_at'])
            ->with('type')
            ->with('country')
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.index')->with('animes', $animes);
    }

    public function create(): View
    {
        $types = Type::all();
        $genres = Genre::all();
        $studios = Studio::all();
        $countries = Country::all();
        $age_ratings = AgeRatingEnum::cases();
        $statuses = StatusEnum::cases();

        return view('admin.anime.create')
            ->with('types', $types)
            ->with('genres', $genres)
            ->with('studios', $studios)
            ->with('countries', $countries)
            ->with('age_ratings', $age_ratings)
            ->with('statuses', $statuses);
    }

    public function store(AnimeStoreRequest $request, AnimeServices $animeServices): RedirectResponse
    {
        return $animeServices->store($request);
    }

    public function edit($animeSlug): View
    {
        $anime = Anime::query()
            ->withoutGlobalScopes()
            ->where('slug', $animeSlug)
            ->firstOrFail();

        $types = Type::all();
        $genres = Genre::all();
        $studios = Studio::all();
        $countries = Country::all();
        $age_ratings = AgeRatingEnum::cases();
        $statuses = StatusEnum::cases();

        return view('admin.anime.edit')
            ->with('anime', $anime)
            ->with('types', $types)
            ->with('genres', $genres)
            ->with('studios', $studios)
            ->with('countries', $countries)
            ->with('age_ratings', $age_ratings)
            ->with('statuses', $statuses);
    }

    public function update(Request $request, $animeSlug, AnimeServices $animeServices): RedirectResponse
    {
        $anime = Anime::query()
            ->withoutGlobalScopes()
            ->where('slug', $animeSlug)
            ->firstOrFail();
        $request->validate((new AnimeUpdateRequest())->rules($anime->id), (new AnimeUpdateRequest())->messages());

        return $animeServices->update($request, $anime);
    }

    public function restore($animeSlug): RedirectResponse
    {
        $anime = Anime::withTrashed()
            ->withoutGlobalScopes()
            ->where('slug', $animeSlug)
            ->firstOrFail();
        $anime->restore();

        return redirect()->route('admin.anime.index')->with('message', "Аниме {$anime->title_ru} восстановлено.");
    }

    public function draft(): View
    {
        $animes = Anime::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::DRAFT)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.index')->with('animes', $animes);
    }

    public function published(): View
    {
        $animes = Anime::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::PUBLISHED)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.index')->with('animes', $animes);
    }

    public function archive(): View
    {
        $animes = Anime::query()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::ARCHIVE)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.index')->with('animes', $animes);
    }

    public function deleted(): View
    {
        $animes = Anime::query()
            ->onlyTrashed()
            ->withoutGlobalScopes()
            ->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.deleted')->with('animes', $animes);
    }

    public function regenerateSlug($animeSlug)
    {
        $anime = Anime::query()
            ->withoutGlobalScopes()
            ->where('slug', $animeSlug)
            ->firstOrFail();

        $anime->generateSlug();
        $anime->timestamps = false;
        $anime->update();

        return redirect()->route('admin.anime.index')->with('message', "Для аниме {$anime->title_ru} перегенерирован слаг.");
    }
}
