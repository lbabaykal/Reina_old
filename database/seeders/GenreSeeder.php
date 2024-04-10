<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{

    public function run(): void
    {

        Genre::query()->create([
            'title_ru' => 'Боевые искусства',
            'title_en' => 'Combat',
        ]);

        Genre::query()->create([
            'title_ru' => 'Детектив',
            'title_en' => 'Detective',
        ]);

        Genre::query()->create([
            'title_ru' => 'Драма',
            'title_en' => 'Drama',
        ]);

        Genre::query()->create([
            'title_ru' => 'Комедия',
            'title_en' => 'Comedy',
        ]);

        Genre::query()->create([
            'title_ru' => 'Махо-сёдзё',
            'title_en' => 'Maho',
        ]);

        Genre::query()->create([
            'title_ru' => 'Меха',
            'title_en' => 'Furs',
        ]);

        Genre::query()->create([
            'title_ru' => 'Мистика',
            'title_en' => 'Mystic',
        ]);

        Genre::query()->create([
            'title_ru' => 'Музыкальный',
            'title_en' => 'Musical',
        ]);

        Genre::query()->create([
            'title_ru' => 'Образовательный',
            'title_en' => 'Educational',
        ]);

        Genre::query()->create([
            'title_ru' => 'Повседневность',
            'title_en' => 'Everyday life',
        ]);

        Genre::query()->create([
            'title_ru' => 'Приключения',
            'title_en' => 'Adventures',
        ]);

        Genre::query()->create([
            'title_ru' => 'Романтика',
            'title_en' => 'Romance',
        ]);

        Genre::query()->create([
            'title_ru' => 'Сёнен',
            'title_en' => 'Shonen',
        ]);

        Genre::query()->create([
            'title_ru' => 'Сёдзё',
            'title_en' => 'Shoujo',
        ]);

        Genre::query()->create([
            'title_ru' => 'Спорт',
            'title_en' => 'Sport',
        ]);

        Genre::query()->create([
            'title_ru' => 'Триллер',
            'title_en' => 'Thriller',
        ]);

        Genre::query()->create([
            'title_ru' => 'Фантастика',
            'title_en' => 'Fantastic',
        ]);

        Genre::query()->create([
            'title_ru' => 'Фэнтези',
            'title_en' => 'Fantasy',
        ]);

        Genre::query()->create([
            'title_ru' => 'Этти',
            'title_en' => 'Etty',
        ]);

        Genre::query()->create([
            'title_ru' => 'Ужасы',
            'title_en' => 'Horror',
        ]);

        Genre::query()->create([
            'title_ru' => 'Мелодрама',
            'title_en' => 'Melodrama',
        ]);

    }
}
