<?php

namespace Database\Seeders;

use App\Models\FolderAnime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderAnimeSeeder extends Seeder
{
    public function run(): void
    {
        FolderAnime::query()->create([
            'title' => 'Смотрю',
            'user_id' => 0,
        ]);

        FolderAnime::query()->create([
            'title' => 'В планах',
            'user_id' => 0,
        ]);

        FolderAnime::query()->create([
            'title' => 'Просмотрено',
            'user_id' => 0,
        ]);

        FolderAnime::query()->create([
            'title' => 'Любимое',
            'user_id' => 0,
        ]);

        FolderAnime::query()->create([
            'title' => 'Брошено',
            'user_id' => 0,
        ]);
    }
}
