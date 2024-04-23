<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Folder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'user_id',
        'folderable_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplyFolderFilter($query, $date)
    {
        return $query->where('folderable_type', $date);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritesUser()
    {
        return $this->hasMany(Favorite::class)
            ->where('user_id', auth()->id());
    }

    public function folderAnimes(): HasManyThrough
    {
        return $this->hasManyThrough(Anime::class, Favorite::class, 'folder_id', 'id', 'id', 'favoriteable_id')
            ->where('favoriteable_type', Anime::class);
    }

    public function folderDoramas(): HasManyThrough
    {
        return $this->hasManyThrough(Dorama::class, Favorite::class, 'folder_id', 'id', 'id', 'favoriteable_id')
            ->where('favoriteable_type', Dorama::class);
    }

}
