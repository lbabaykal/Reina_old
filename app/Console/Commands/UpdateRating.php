<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Dorama;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class UpdateRating extends Command
{
    protected $signature = 'app:update-rating';
    protected $description = 'Обновление рейтинга.';

    public function handle()
    {
        $startTime = microtime(true);
        $startMemory = memory_get_peak_usage(true);

        foreach (Anime::withCount('ratings')->cursor() as $anime) {
            $anime->rating = round($anime->ratings()->avg('assessment'), 1);
            $anime->count_assessments = $anime->ratings_count;
            $anime->timestamps = false;
            $anime->update();
        }

        foreach (Dorama::withCount('ratings')->cursor() as $dorama) {
            $dorama->rating = round($dorama->ratings()->avg('assessment'), 1);
            $dorama->count_assessments = $dorama->ratings_count;
            $dorama->timestamps = false;
            $dorama->update();
        }

        $endTime = microtime(true);
        $endMemory = memory_get_peak_usage(true);

        $executionTime = round($endTime - $startTime, 2);
        $memoryUsage = round(($endMemory - $startMemory) / 1024 / 1024, 2);

        echo "Время выполнения: {$executionTime} seconds\n";
        echo "Памяти использовано: {$memoryUsage} MB\n";
    }
}
