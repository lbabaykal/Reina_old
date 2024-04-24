<?php

namespace App\Models\Scopes;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', StatusEnum::PUBLISHED);
    }
}
