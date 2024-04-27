<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class GenreFilter extends AbstractFilter
{
    public function applyFilter(Builder $builder): void
    {
        if (request()->boolean('strict_genre')) {
            //Поиск с сужением
            $genreIds = request()->collect('genre');
            $builder->whereHas('genres', function (Builder $query) use ($genreIds) {
                $query->whereIn('genre_id', $genreIds);
            }, count($genreIds));
        } else {
            //Поиск обычный
            $builder->whereHas('genres', function (Builder $query) {
                $query->whereIn('genre_id', request()->collect('genre'));
            });
        }
    }
}
