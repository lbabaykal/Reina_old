<?php

namespace App\Services;

use App\Models\Dorama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DoramaServices
{
    public function store(Request $request): RedirectResponse
    {
        $imageServices = new ImageServices();

        $dorama = new Dorama();
        $dorama->poster = $imageServices->saveWebp($request, 'poster', 'dorama_posters');
        $dorama->cover = $imageServices->saveWebp($request, 'cover', 'dorama_covers');

        $dorama->title_org = $request->input('title_org');
        $dorama->title_ru = $request->input('title_ru');
        $dorama->title_en = $request->input('title_en');

        $dorama->type_id = $request->input('type');
        $dorama->country_id = $request->input('country');

        $dorama->genre_id = null;
        $genres = $request->input('genres') ?? null;

        $dorama->studio_id = null;
        $studios = $request->input('studios') ?? null;

        $dorama->age_rating = $request->input('age_rating');
        $dorama->episodes_released = 0;
        $dorama->episodes_total = $request->input('episodes_total');
        $dorama->duration = $request->input('duration');
        $dorama->release = $request->date('release');
        $dorama->description = $request->input('description');
        $dorama->user_id = auth()->id();
        $dorama->status = $request->input('status');

        $dorama->rating = 0;
        $dorama->count_assessments = 0;

        $dorama->is_comment = $request->boolean('is_comment');
        $dorama->is_rating = $request->boolean('is_rating');

        try {
            DB::transaction(function () use ($dorama, $genres, $studios){
                $dorama->update();

                $dorama->genres()->attach($genres);
                $dorama->studios()->attach($studios);
            });
            return redirect()->route('admin.dorama.index')->with('message', "Дорама {$dorama->title_ru} добавлена.");
        } catch (\Exception $e) {

            if (! is_null($dorama->poster)) {
                Storage::disk('dorama_posters')->delete($dorama->poster);
            }

            if (! is_null($dorama->cover)) {
                Storage::disk('dorama_covers')->delete($dorama->cover);
            }

            return redirect()->back()->with('message', "Ошибка выполнения транзакции.");
        }
    }

    public function update(Request $request, Model $dorama): RedirectResponse
    {
        $imageServices = new ImageServices();

        $dorama->poster = $imageServices->saveWebp($request, 'poster', 'dorama_posters') ?? $dorama->poster;
        $dorama->cover = $imageServices->saveWebp($request, 'cover', 'dorama_covers') ?? $dorama->cover;

        $dorama->title_org = $request->input('title_org');
        $dorama->title_ru = $request->input('title_ru');
        $dorama->title_en = $request->input('title_en');

        $dorama->type_id = $request->input('type');
        $dorama->country_id = $request->input('country');

        $dorama->genre_id = null;
        $genres = $request->input('genres') ?? null;

        $dorama->studio_id = null;
        $studios = $request->input('studios') ?? null;

        $dorama->age_rating = $request->input('age_rating');
        $dorama->episodes_total = $request->input('episodes_total');
        $dorama->duration = $request->input('duration');
        $dorama->release = $request->input('release');
        $dorama->description = $request->input('description');
        $dorama->user_id = auth()->id();
        $dorama->status = $request->input('status');

        $dorama->rating = 0;
        $dorama->count_assessments = 0;

        $dorama->is_comment = $request->boolean('is_comment');
        $dorama->is_rating = $request->boolean('is_rating');

        try {
            DB::transaction(function () use ($dorama, $genres, $studios){
                $dorama->update();

                $dorama->genres()->sync($genres);
                $dorama->studios()->sync($studios);
            });
            return redirect()->route('admin.dorama.index')->with('message', "Дорама {$dorama->title_ru} обновлена.");
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Ошибка выполнения транзакции.");
        }
    }

}
