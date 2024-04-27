<?php

namespace App\Http\Controllers;

use App\Http\Filters\Fields\CountryFilter;
use App\Http\Filters\Fields\GenreFilter;
use App\Http\Filters\Fields\StudioFilter;
use App\Http\Filters\Fields\TitleFilter;
use App\Http\Filters\Fields\TypeFilter;
use App\Http\Filters\Fields\YearFromFilter;
use App\Http\Filters\Fields\YearToFilter;
use App\Models\Anime;
use App\Models\Country;
use App\Models\Dorama;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Reina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class SearchController extends Controller
{

    public function __invoke(Request $request): View
    {

        $animes = Pipeline::send(
            Anime::query()
//                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->limit(Reina::COUNT_ARTICLES_SEARCH)
                ->latest('updated_at')
        )
            ->through([
                TitleFilter::class,
                TypeFilter::class,
                GenreFilter::class,
                CountryFilter::class,
                StudioFilter::class,
                YearFromFilter::class,
                YearToFilter::class,
            ])
            ->thenReturn();

        $doramas = Pipeline::send(
            Dorama::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->limit(Reina::COUNT_ARTICLES_SEARCH)
                ->latest('updated_at')
        )
            ->through([
                TitleFilter::class,
                TypeFilter::class,
                GenreFilter::class,
                CountryFilter::class,
                StudioFilter::class,
                YearFromFilter::class,
                YearToFilter::class,
            ])
            ->thenReturn();

        return view('layouts.search.index')
            ->with('types', Type::all())
            ->with('genres', Genre::all())
            ->with('studios', Studio::all())
            ->with('countries', Country::all())
            ->with('animes', $animes->paginate(Reina::COUNT_ARTICLES_FULL)->withQueryString())
            ->with('doramas', $doramas->paginate(Reina::COUNT_ARTICLES_FULL)->withQueryString());
    }


    public function anime(Request $request): View
    {
        $animes = Pipeline::send(
            Anime::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->latest('updated_at')
        )
            ->through([
                TitleFilter::class,
                TypeFilter::class,
                GenreFilter::class,
                CountryFilter::class,
                StudioFilter::class,
                YearFromFilter::class,
                YearToFilter::class,
            ])
            ->thenReturn();

        return view('layouts.search.anime')
            ->with('types', Type::all())
            ->with('genres', Genre::all())
            ->with('studios', Studio::all())
            ->with('countries', Country::all())
            ->with('animes', $animes->paginate(Reina::COUNT_ARTICLES_FULL)->withQueryString());
    }

    public function dorama(Request $request): View
    {
        $doramas = Pipeline::send(
            Dorama::query()
                ->select(['slug', 'poster', 'title_ru', 'rating', 'episodes_released', 'episodes_total'])
                ->limit(Reina::COUNT_ARTICLES_SEARCH)
                ->latest('updated_at')
        )
            ->through([
                TitleFilter::class,
                TypeFilter::class,
                GenreFilter::class,
                CountryFilter::class,
                StudioFilter::class,
                YearFromFilter::class,
                YearToFilter::class,
            ])
            ->thenReturn();

        return view('layouts.search.dorama')
            ->with('types', Type::all())
            ->with('genres', Genre::all())
            ->with('studios', Studio::all())
            ->with('countries', Country::all())
            ->with('doramas', $doramas->paginate(Reina::COUNT_ARTICLES_FULL)->withQueryString());
    }

}
