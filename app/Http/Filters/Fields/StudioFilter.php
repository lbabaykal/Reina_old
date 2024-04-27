<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class StudioFilter extends AbstractFilter
{
    public function applyFilter(Builder $builder): void
    {
        if (request()->boolean('strict_studio')) {
            //Поиск с сужением
            $studioIds = request()->collect('studio');
            $builder->whereHas('studios', function (Builder $query) use ($studioIds) {
                $query->whereIn('studio_id', $studioIds);
            }, count($studioIds));
        } else {
            //Поиск обычный
            $builder->whereHas('studios', function (Builder $query) {
                $query->whereIn('studio_id', request()->collect('studio'));
            });
        }
    }
}
