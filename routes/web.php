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
use App\Http\Controllers\Folder\AnimeFolderController;
use App\Http\Controllers\Folder\DoramaFolderController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SearchController;
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

//========================================================================================

Route::get('/', MainController::class)->name('main');
Route::get('/search', SearchController::class)->name('search');
Route::get('/search_anime', [SearchController::class, 'anime'])->name('search.anime');
Route::get('/search_dorama', [SearchController::class, 'dorama'])->name('search.dorama');

// ====ANIME====
Route::prefix('anime')->name('anime.')->group(function () {
    Route::get('/{anime:slug}', [AnimeController::class, 'show'])->name('show');
    Route::get('/', [AnimeController::class, 'index'])->name('index');

    Route::middleware('auth')->group(function () {
        Route::post('/{anime:slug}/rating', [AnimeController::class, 'rating'])->name('rating');
        Route::post('/{anime:slug}/favorite', [AnimeController::class, 'favorite'])->name('favorite');
    });
});

// ====DORAMA====
Route::prefix('dorama')->name('dorama.')->group(function () {
    Route::get('/{dorama:slug}', [DoramaController::class, 'show'])->name('show');
    Route::get('/', [DoramaController::class, 'index'])->name('index');

    Route::middleware('auth')->group(function () {
        Route::post('/{dorama:slug}/rating', [DoramaController::class, 'rating'])->name('rating');
        Route::post('/{dorama:slug}/favorite', [DoramaController::class, 'favorite'])->name('favorite');
    });
});

// ====FOLDERS====
Route::middleware('auth')->prefix('folders')->name('folders.')->group(function () {
    Route::get('/', [FolderController::class, 'index'])->name('index');
    Route::get('/{folder}/edit', [FolderController::class, 'edit'])->name('edit');
    Route::patch('/{folder}', [FolderController::class, 'update'])->name('update');
    Route::delete('/{folder}', [FolderController::class, 'destroy'])->name('destroy');


    Route::prefix('animes')->name('animes.')->group(function () {
        Route::get('/', [AnimeFolderController::class, 'index'])->name('index');
        Route::get('/create', [AnimeFolderController::class, 'create'])->name('create');
        Route::post('/', [AnimeFolderController::class, 'store'])->name('store');
        Route::get('/{folder}', [AnimeFolderController::class, 'show'])->name('show');
    });

    Route::prefix('doramas')->name('doramas.')->group(function () {
        Route::get('/', [DoramaFolderController::class, 'index'])->name('index');
        Route::get('/create', [DoramaFolderController::class, 'create'])->name('create');
        Route::post('/', [DoramaFolderController::class, 'store'])->name('store');
        Route::get('/{folder}', [DoramaFolderController::class, 'show'])->name('show');
    });
});

// ====ADMIN====
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', AdminPanelController::class)->name('index');

        Route::resource('/anime', AnimeAdminController::class)->except(['show', 'destroy',]);
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
