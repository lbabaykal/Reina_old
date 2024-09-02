<?php

namespace Database\Seeders;

use App\Models\FolderDorama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderDoramaSeeder extends Seeder
{
    public function run(): void
    {
        FolderDorama::query()->create([
            'title' => 'Смотрю',
            'user_id' => 0,
        ]);

        FolderDorama::query()->create([
            'title' => 'В планах',
            'user_id' => 0,
        ]);

        FolderDorama::query()->create([
            'title' => 'Просмотрено',
            'user_id' => 0,
        ]);

        FolderDorama::query()->create([
            'title' => 'Любимое',
            'user_id' => 0,
        ]);

        FolderDorama::query()->create([
            'title' => 'Брошено',
            'user_id' => 0,
        ]);
    }
}
