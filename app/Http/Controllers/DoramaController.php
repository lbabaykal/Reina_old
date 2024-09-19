<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Filters\Fields\CountryFilter;
use App\Http\Filters\Fields\GenreFilter;
use App\Http\Filters\Fields\SortingFilter;
use App\Http\Filters\Fields\StudioFilter;
use App\Http\Filters\Fields\TitleFilter;
use App\Http\Filters\Fields\TypeFilter;
use App\Http\Filters\Fields\YearFromFilter;
use App\Http\Filters\Fields\YearToFilter;
use App\Http\Requests\FavoriteDoramasRequest;
use App\Http\Requests\RatingRequest;
use App\Models\Country;
use App\Models\Dorama;
use App\Models\FolderDorama;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Reina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class DoramaController extends Controller
{

    public function index(): View
    {
        request()->merge(['sorting' => request()->input('sorting', 1)]);

        $doramas = Pipeline::send(
            Dorama::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
        )
            ->through([
                TitleFilter::class,
                TypeFilter::class,
                GenreFilter::class,
                CountryFilter::class,
                StudioFilter::class,
                YearFromFilter::class,
                YearToFilter::class,
                SortingFilter::class,
            ])
            ->thenReturn();

        return view('layouts.dorama.index')
            ->with('types', Type::all())
            ->with('genres', Genre::all())
            ->with('studios', Studio::all())
            ->with('countries', Country::all())
            ->with('doramas', $doramas->paginate(Reina::COUNT_ARTICLES_FULL)->withQueryString());
    }

    public function show($slug): View
    {
        $dorama = Cache::store('redis_doramas')->remember('dorama:'.$slug, 600, function () use ($slug) {
            return Dorama::query()
                ->where('slug', $slug)
                ->with('type')
                ->with('country')
                ->with('studios')
                ->with('genres')
                ->firstOrFail();
        });

        $ratingUser = $dorama->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $dorama->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_dorama_id');

        $foldersUser = FolderDorama::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->orderBy('id')
            ->get();

        return view('layouts.dorama.show')
            ->with('dorama', $dorama)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser);
    }

    public function watch($slug): View
    {
        $dorama = Cache::store('redis_doramas')->remember('dorama_watch:'.$slug, 600, function () use ($slug) {
            return Dorama::query()
                ->where('slug', $slug)
                ->with('type')
                ->with('genres')
                ->firstOrFail();
        });

        $ratingUser = $dorama->ratings()
            ->where('user_id', auth()->id())
            ->value('assessment');

        $favoriteUser = $dorama->favorites()
            ->where('user_id', auth()->id())
            ->value('folder_dorama_id');

        $foldersUser = FolderDorama::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->orderBy('id')
            ->get();

        $episodes = $dorama->doramaEpisodes()
            ->where('status', StatusEnum::PUBLISHED)
            ->orderBy('number')
            ->get();

        return view('layouts.dorama.watch')
            ->with('dorama', $dorama)
            ->with('favoriteUser', $favoriteUser)
            ->with('ratingUser', $ratingUser)
            ->with('foldersUser', $foldersUser)
            ->with('episodes', $episodes);
    }

}
