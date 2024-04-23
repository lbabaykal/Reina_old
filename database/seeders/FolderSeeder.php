<?php

namespace Database\Seeders;

use App\Models\Anime;
use App\Models\Dorama;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{

    public function run(): void
    {
        Folder::query()->create([
            'title' => 'Смотрю',
            'user_id' => 0,
            'folderable_type' => Anime::class,
        ]);

        Folder::query()->create([
            'title' => 'В планах',
            'user_id' => 0,
            'folderable_type' => Anime::class,
        ]);

        Folder::query()->create([
            'title' => 'Просмотрено',
            'user_id' => 0,
            'folderable_type' => Anime::class,
        ]);

        Folder::query()->create([
            'title' => 'Любимое',
            'user_id' => 0,
            'folderable_type' => Anime::class,
        ]);

        Folder::query()->create([
            'title' => 'Брошено',
            'user_id' => 0,
            'folderable_type' => Anime::class,
        ]);



        Folder::query()->create([
            'title' => 'Смотрю',
            'user_id' => 0,
            'folderable_type' => Dorama::class,
        ]);

        Folder::query()->create([
            'title' => 'В планах',
            'user_id' => 0,
            'folderable_type' => Dorama::class,
        ]);

        Folder::query()->create([
            'title' => 'Просмотрено',
            'user_id' => 0,
            'folderable_type' => Dorama::class,
        ]);

        Folder::query()->create([
            'title' => 'Любимое',
            'user_id' => 0,
            'folderable_type' => Dorama::class,
        ]);

        $lastFolderDorama = Folder::query()->create([
            'title' => 'Брошено',
            'user_id' => 0,
            'folderable_type' => Dorama::class,
        ]);

        for ($i = $lastFolderDorama->id + 1; $i <= 100; $i++) {
            Folder::query()->create([
                'title' => $i,
                'user_id' => 0,
                'folderable_type' => 0,
            ]);
        }
    }
}
