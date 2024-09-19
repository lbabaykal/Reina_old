<?php

namespace App\Services;

use App\Models\Anime;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnimeServices
{
    public function store(Request $request): RedirectResponse
    {
        $anime = new Anime();

        $PosterImageService = new ImageService();
        $anime->poster = $PosterImageService
            ->setFileField('poster')
            ->setStorage('anime_posters')
            ->save();

        $CoverImageService = new ImageService();
        $anime->cover = $CoverImageService
            ->setFileField('cover')
            ->setStorage('anime_covers')
            ->save();

        $anime->title_org = $request->input('title_org');
        $anime->title_ru = $request->input('title_ru');
        $anime->title_en = $request->input('title_en');

        $anime->type_id = $request->input('type');
        $anime->country_id = $request->input('country');

        $anime->genre_id = null;
        $genres = $request->input('genres') ?? null;

        $anime->studio_id = null;
        $studios = $request->input('studios') ?? null;

        $anime->age_rating = $request->input('age_rating');
        $anime->episodes_released = 0;
        $anime->episodes_total = $request->input('episodes_total');
        $anime->duration = $request->input('duration');
        $anime->release = $request->date('release');
        $anime->description = $request->input('description');
        $anime->status = $request->input('status');

        $anime->rating = 0;
        $anime->count_assessments = 0;

        $anime->is_comment = $request->boolean('is_comment');
        $anime->is_rating = $request->boolean('is_rating');

        try {
            DB::transaction(function () use ($anime, $genres, $studios){
                $anime->save();

                $anime->genres()->attach($genres);
                $anime->studios()->attach($studios);
            });
            return redirect()->route('admin.anime.index')->with('message', "Аниме {$anime->title_ru} добавлено.");
        } catch (\Exception $e) {

            if (! is_null($anime->poster)) {
                Storage::disk('anime_posters')->delete($anime->poster);
            }

            if (! is_null($anime->cover)) {
                Storage::disk('anime_covers')->delete($anime->cover);
            }

            return redirect()->back()->with('message', "Ошибка выполнения транзакции.");
        }
    }

    public function update(Request $request, Model $anime): RedirectResponse
    {
        if (request()->has('poster')) {
            $PosterImageService = new ImageService();
            $anime->poster = $PosterImageService
                ->setFileField('poster')
                ->setStorage('anime_posters')
                ->save() ?? $anime->poster;
        }

        if (request()->has('cover')) {
            $CoverImageService = new ImageService();
            $anime->cover = $CoverImageService
                ->setFileField('cover')
                ->setStorage('anime_covers')
                ->save() ?? $anime->cover;
        }

        $anime->title_org = $request->input('title_org');
        $anime->title_ru = $request->input('title_ru');
        $anime->title_en = $request->input('title_en');

        $anime->type_id = $request->input('type');
        $anime->country_id = $request->input('country');

        $anime->genre_id = null;
        $genres = $request->input('genres') ?? null;

        $anime->studio_id = null;
        $studios = $request->input('studios') ?? null;

        $anime->age_rating = $request->input('age_rating');
        $anime->episodes_total = $request->input('episodes_total');
        $anime->duration = $request->input('duration');
        $anime->release = $request->input('release');
        $anime->description = $request->input('description');
        $anime->status = $request->input('status');

        $anime->rating = 0;
        $anime->count_assessments = 0;

        $anime->is_comment = $request->boolean('is_comment');
        $anime->is_rating = $request->boolean('is_rating');

        try {
            DB::transaction(function () use ($anime, $genres, $studios){
                $anime->update();

                $anime->genres()->sync($genres);
                $anime->studios()->sync($studios);
            });
            return redirect()->route('admin.anime.index')->with('message', "Аниме {$anime->title_ru} обновлено.");
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Ошибка выполнения транзакции.");
        }

    }

}
