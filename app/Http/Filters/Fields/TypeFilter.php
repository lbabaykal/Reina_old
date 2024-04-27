<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class TypeFilter extends AbstractFilter
{
    public function applyFilter(Builder $builder): void
    {
        $builder->whereHas('type', function (Builder $query) {
            $query->whereIn('type_id', request()->collect('type'));
        });
    }
}
