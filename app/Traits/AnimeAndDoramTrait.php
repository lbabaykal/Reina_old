<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait AnimeAndDoramTrait
{
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studio::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
