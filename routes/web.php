<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\Admin\CountriesAdminController;
use App\Http\Controllers\Admin\DoramaAdminController;
use App\Http\Controllers\Admin\GenreAdminController;
use App\Http\Controllers\Admin\StudiosAdminController;
use App\Http\Controllers\Admin\TypeAdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\DoramaController;
use App\Http\Controllers\MainController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('/filter')->name('article.filter_article');

Route::get('/', MainController::class)->name('main');

Route::get('/anime/{anime:slug}', [AnimeController::class, 'show'])->name('anime.show');
Route::get('/anime', [AnimeController::class, 'index'])->name('anime.index');

Route::get('/dorama/{dorama:slug}', [DoramaController::class, 'show'])->name('dorama.show');
Route::get('/dorama', [DoramaController::class, 'index'])->name('dorama.index');


Route::get('/admin', AdminPanelController::class)
    ->name('admin.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/anime', AnimeAdminController::class)->except(['show', 'destroy']);
    Route::prefix('anime')->name('anime.')->group(function () {
        Route::get('/draft', [AnimeAdminController::class, 'draft'])->name('draft');
        Route::get('/published', [AnimeAdminController::class, 'published'])->name('published');
        Route::get('/archive', [AnimeAdminController::class, 'archive'])->name('archive');
    });

    Route::resource('/dorama', DoramaAdminController::class)->except(['show', 'destroy']);
    Route::prefix('dorama')->name('dorama.')->group(function () {
        Route::get('/draft', [DoramaAdminController::class, 'draft'])->name('draft');
        Route::get('/published', [DoramaAdminController::class, 'published'])->name('published');
        Route::get('/archive', [DoramaAdminController::class, 'archive'])->name('archive');
    });

    Route::resource('/types', TypeAdminController::class)->except(['show', 'destroy']);
    Route::resource('/genres', GenreAdminController::class)->except(['show', 'destroy']);
    Route::resource('/studios', StudiosAdminController::class)->except(['show', 'destroy']);
    Route::resource('/countries', CountriesAdminController::class)->except(['show', 'destroy']);
});

