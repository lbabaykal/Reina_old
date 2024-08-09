<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function foldersAnimes(): HasMany
    {
        return $this->hasMany(FolderAnime::class);
    }

    public function foldersDoramas(): HasMany
    {
        return $this->hasMany(FolderDorama::class);
    }

    public function foldersAnimesWithDefault(): HasMany
    {
        return $this->hasMany(FolderAnime::class)->orWhere('user_id', 0);
    }

    public function foldersDoramasWithDefault(): HasMany
    {
        return $this->hasMany(FolderDorama::class)->orWhere('user_id', 0);
    }

    public function favoriteAnimes(): HasManyThrough
    {
        return $this->hasManyThrough(Anime::class, FavoriteAnime::class, 'user_id', 'id', 'id', 'anime_id');
    }

    public function favoriteDoramas(): HasManyThrough
    {
        return $this->hasManyThrough(Dorama::class, FavoriteDorama::class, 'user_id', 'id', 'id', 'dorama_id');
    }

}
