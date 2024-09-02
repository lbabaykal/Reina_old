<?php

namespace App\Http\Filters\Fields;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class SortingFilter extends AbstractFilter
{
    public function applyFilter(Builder $builder): void
    {
        switch (request()->input('sorting')) {
            case 1:
                $builder->orderByDesc('updated_at');
                break;
            case 2:
                $builder->orderByDesc('rating');
                break;
            case 3:
                $builder->orderByDesc('release');
                break;
            default:
                $builder->orderByDesc('updated_at');
                break;
        }
    }
}
