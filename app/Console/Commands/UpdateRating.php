<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Dorama;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class UpdateRating extends Command
{
    protected $signature = 'update-rating';
    protected $description = 'Обновление рейтинга.';

    public function handle(): void
    {
        $startTime = microtime(true);
        $startMemory = memory_get_peak_usage(true);

        foreach (Anime::query()
                     ->withoutGlobalScopes()
                     ->select(['id', 'title_org', 'title_ru', 'title_en', 'rating', 'count_assessments'])
                     ->withCount('ratings')
                     ->cursor() as $anime) {
            $anime->rating = round($anime->ratings()->avg('assessment'), 1);
            $anime->count_assessments = $anime->ratings_count;
            $anime->timestamps = false;
            $anime->update();
        }
        echo 'Рейтинг Аниме обновлён.' . PHP_EOL;

        foreach (Dorama::query()
                     ->withoutGlobalScopes()
                     ->select(['id', 'title_org', 'title_ru', 'title_en', 'rating', 'count_assessments'])
                     ->withCount('ratings')
                     ->cursor() as $dorama) {
            $dorama->rating = round($dorama->ratings()->avg('assessment'), 1);
            $dorama->count_assessments = $dorama->ratings_count;
            $dorama->timestamps = false;
            $dorama->update();
        }
        echo 'Рейтинг Дорам обновлён.' . PHP_EOL;

        Cache::store('redis_animes')->forget('main_animes');
        Cache::store('redis_doramas')->forget('main_doramas');
        echo 'Кеш Аниме и Дорам сброшен.' . PHP_EOL;

        $endTime = microtime(true);
        $endMemory = memory_get_peak_usage(true);

        $executionTime = round($endTime - $startTime, 2);
        $memoryUsage = round(($endMemory - $startMemory) / 1024 / 1024, 2);

        echo "Время выполнения: {$executionTime} seconds\n";
        echo "Памяти использовано: {$memoryUsage} MB\n";
    }
}
