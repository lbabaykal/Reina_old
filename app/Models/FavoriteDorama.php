<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteDorama extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'anime_id',
        'folder_dorama_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foldersDorama(): BelongsTo
    {
        return $this->belongsTo(FolderDorama::class);
    }
}
