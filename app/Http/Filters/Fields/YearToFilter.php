<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class YearToFilter extends AbstractFilter
{
    public function applyFilter(Builder $builder): void
    {
        $builder->whereYear('release', '<=', request()->input('year_to'));
    }
}
