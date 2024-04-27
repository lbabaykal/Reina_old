<?php

namespace App\Http\Filters;

use App\Http\Requests\SearchRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class AbstractFilter implements FilterInterface
{

    public function handle(Builder $builder, \Closure $next)
    {
        $request = request()->validate((new SearchRequest())->rules());

        if (isset($request[$this->getName()])) {
            $this->applyFilter($builder);
        }
        return $next($builder);
    }

    public function getName(): string
    {
        return Str::snake(Str::before(class_basename($this), 'Filter'));
    }

}
