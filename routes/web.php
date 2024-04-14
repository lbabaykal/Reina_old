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

Route::prefix('anime')->name('anime.')->group(function () {
    Route::get('/{anime:slug}', [AnimeController::class, 'show'])->name('show');
    Route::get('/', [AnimeController::class, 'index'])->name('index');

    Route::middleware('auth')->post('/{anime:slug}/rating', [AnimeController::class, 'rating'])
        ->name('rating');
});


Route::prefix('dorama')->name('dorama.')->group(function () {
    Route::get('/{dorama:slug}', [DoramaController::class, 'show'])->name('show');
    Route::get('/', [DoramaController::class, 'index'])->name('index');

    Route::middleware('auth')->post('/{dorama:slug}/rating', [DoramaController::class, 'rating'])
        ->name('rating');
});



Route::get('/admin', AdminPanelController::class)
    ->name('admin.index');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/anime', AnimeAdminController::class)->except(['show', 'destroy']);
    Route::prefix('anime')->name('anime.')->group(function () {
        Route::get('/draft', [AnimeAdminController::class, 'draft'])->name('draft');
        Route::get('/published', [AnimeAdminController::class, 'published'])->name('published');
        Route::get('/archive', [AnimeAdminController::class, 'archive'])->name('archive');
        Route::get('/deleted', [AnimeAdminController::class, 'deleted'])->name('deleted');
        Route::get('/{anime:slug}/restore', [AnimeAdminController::class, 'restore'])->name('restore');
    });

    Route::resource('/dorama', DoramaAdminController::class)->except(['show', 'destroy']);
    Route::prefix('dorama')->name('dorama.')->group(function () {
        Route::get('/draft', [DoramaAdminController::class, 'draft'])->name('draft');
        Route::get('/published', [DoramaAdminController::class, 'published'])->name('published');
        Route::get('/archive', [DoramaAdminController::class, 'archive'])->name('archive');
        Route::get('/deleted', [DoramaAdminController::class, 'deleted'])->name('deleted');
        Route::get('/{dorama:slug}/restore', [DoramaAdminController::class, 'restore'])->name('restore');
    });

    Route::resource('/types', TypeAdminController::class)->except(['show', 'destroy']);
    Route::resource('/genres', GenreAdminController::class)->except(['show', 'destroy']);
    Route::resource('/studios', StudiosAdminController::class)->except(['show', 'destroy']);
    Route::resource('/countries', CountriesAdminController::class)->except(['show', 'destroy']);
});

