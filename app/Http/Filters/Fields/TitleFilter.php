<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class TitleFilter extends AbstractFilter
{

    public function applyFilter(Builder $builder): void
    {
        $builder->where(function (Builder $query)
        {
            $query->where('title_org', 'ILIKE', '%' . request()->input('title') . '%')
                ->orWhere('title_ru', 'ILIKE', '%' . request()->input('title') . '%')
                ->orWhere('title_en', 'ILIKE', '%' . request()->input('title') . '%')
            ;
        });
    }

}
