<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class AbstractFilter implements FilterInterface
{
    public function handle(Builder $builder, \Closure $next)
    {
        if (request()->has($this->getName())) {
            $this->applyFilter($builder);
        }
        return $next($builder);
    }

    public function getName(): string
    {
        return Str::snake(Str::before(class_basename($this), 'Filter'));
    }
}
