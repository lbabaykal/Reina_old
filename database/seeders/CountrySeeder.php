<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{

    public function run(): void
    {
        Country::query()->create([
            'title_ru' => 'Япония',
            'title_en' => 'Japan',
        ]);

        Country::query()->create([
            'title_ru' => 'Китай',
            'title_en' => 'China',
        ]);

        Country::query()->create([
            'title_ru' => 'Южная Корея',
            'title_en' => 'South Korea',
        ]);

        Country::query()->create([
            'title_ru' => 'Таиланд',
            'title_en' => 'Thailand',
        ]);

        Country::query()->create([
            'title_ru' => 'Гонконг',
            'title_en' => 'Hong Kong',
        ]);
    }
}
