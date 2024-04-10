<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{

    public function run(): void
    {
        Type::query()->create([
            'title_ru' => 'TV Сериал',
            'title_en' => 'TV series',
        ]);

        Type::query()->create([
            'title_ru' => 'Фильм',
            'title_en' => 'Film',
        ]);

        Type::query()->create([
            'title_ru' => 'Special',
            'title_en' => 'Special',
        ]);

        Type::query()->create([
            'title_ru' => 'OVA',
            'title_en' => 'OVA',
        ]);
    }
}
