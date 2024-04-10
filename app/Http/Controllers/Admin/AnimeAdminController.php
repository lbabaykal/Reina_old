<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AgeRatingEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeRequest;
use App\Models\Anime;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Reina;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AnimeAdminController extends Controller
{

    public function index(): View
    {
        $animes = Anime::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id'])
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

    public function store(AnimeRequest $request, ImageServices $imageServices)
    {

        $anime = new Anime();
        $anime->poster = $imageServices->saveWebp($request, 'poster', 'anime_posters');
        $anime->cover = $imageServices->saveWebp($request, 'cover', 'anime_covers');

        $anime->title_org = $request->input('title_org');
        $anime->title_ru = $request->input('title_ru');
        $anime->title_en = $request->input('title_en');

        $anime->type_id = $request->input('type');
        $anime->country_id = $request->input('country');

        $anime->genre_id = null;
        $genres = $request->input('genres') ?? null;

        $anime->studio_id = null;
        $studios = $request->input('studios') ?? null;

        $anime->age_rating = $request->input('age_rating');
        $anime->episodes_released = $request->input('episodes_released');
        $anime->episodes_total = $request->input('episodes_total');
        $anime->duration = $request->input('duration');
        $anime->release = $request->date('release');
        $anime->description = $request->input('description');
        $anime->user_id = auth()->id();
        $anime->status = $request->input('status');

        $anime->rating = 0;
        $anime->count_assessments = 0;

        $anime->is_comment = $request->boolean('is_comment');
        $anime->is_rating = $request->boolean('is_rating');

        try {
            DB::transaction(function () use ($anime, $genres, $studios){
                $anime->save();

                $anime->genres()->attach($genres);
                $anime->studios()->attach($studios);
            });
            return redirect()->route('admin.anime.index')->with('message', "Аниме {$anime->title_ru} добавлено.");
        } catch (\Exception $e) {

            if (! is_null($anime->poster)) {
                Storage::disk('anime_posters')->delete($anime->poster);
            }

            if (! is_null($anime->cover)) {
                Storage::disk('anime_covers')->delete($anime->cover);
            }

            return redirect()->back()->with('message', "Ошибка выполнения транзакции.");
        }

    }

    public function edit(Anime $anime): View
    {
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

    public function update(AnimeRequest $request, Anime $anime): RedirectResponse
    {
        $fileName = $this->uploadImage($request);

        $data = $request->validated();
        $data['poster'] = $fileName ?? $article->poster;
        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $studios = $data['studio_id'] ?? null;
        unset($data['genre_id'], $data['studio_id']);

        $article->update($data);
        $article->genres()->sync($genres);
        $article->studios()->sync($studios);

        return $article;
    }

    public function draft(): View
    {
        $animes = Anime::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
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
        $animes = Anime::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
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
        $animes = Anime::query()->select(['slug', 'title_ru', 'status', 'rating', 'type_id', 'country_id', 'status'])
            ->with('type')
            ->with('country')
            ->where('status', StatusEnum::ARCHIVE)
            ->latest('updated_at')
            ->paginate(Reina::COUNT_ADMIN_ITEMS)
            ->withQueryString();

        return view('admin.anime.index')->with('animes', $animes);
    }
}
