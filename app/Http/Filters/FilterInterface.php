<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function applyFilter(Builder $builder);
}
