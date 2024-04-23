<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'folder_id',
        'favoriteable_type',
        'favoriteable_id',
    ];

    public function favoriteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplyFavoriteFilter($query, $data)
    {
        return $query->where('favoriteable_type', $data);
    }

    public function folders()
    {
        return $this->belongsTo(Folder::class);
    }

}
