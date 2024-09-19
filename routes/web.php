<?php

use App\Http\Controllers\AdminPanel\AdminPanelController;
use App\Http\Controllers\AdminPanel\AnimeAdminController;
use App\Http\Controllers\AdminPanel\AnimeEpisodesAdminController;
use App\Http\Controllers\AdminPanel\CountriesAdminController;
use App\Http\Controllers\AdminPanel\DoramaAdminController;
use App\Http\Controllers\AdminPanel\DoramaEpisodesAdminController;
use App\Http\Controllers\AdminPanel\GenreAdminController;
use App\Http\Controllers\AdminPanel\StudiosAdminController;
use App\Http\Controllers\AdminPanel\TypeAdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\DoramaController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Folder\AnimeFolderController;
use App\Http\Controllers\Folder\DoramaFolderController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/1111', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});




//Route::get('/{page?}', function() {
//    return view('app');
//})->where('page', '[\/\w\.-]*');

//========================================================================================

// ====SEARCH====
Route::get('/', MainController::class)->name('main');
Route::get('/search', SearchController::class)->name('search');

// ====ANIME====
Route::prefix('anime')->name('anime.')->group(function () {
    Route::get('/{anime:slug}', [AnimeController::class, 'show'])->name('show');
    Route::get('/{anime:slug}/watch', [AnimeController::class, 'watch'])->name('watch');
    Route::get('/', [AnimeController::class, 'index'])->name('index');

    Route::middleware('auth')->group(function () {
        Route::patch('/{anime:slug}/rating', [RatingController::class, 'addToAnime'])->name('rating.add');
        Route::delete('/{anime:slug}/rating', [RatingController::class, 'removeToAnime'])->name('rating.remove');
        Route::patch('/{anime:slug}/favorite', [FavoriteController::class, 'addToAnime'])->name('favorite.add');
        Route::delete('/{anime:slug}/favorite', [FavoriteController::class, 'removeToAnime'])->name('favorite.remove');
    });
});

// ====DORAMA====
Route::prefix('dorama')->name('dorama.')->group(function () {
    Route::get('/{dorama:slug}', [DoramaController::class, 'show'])->name('show');
    Route::get('/{dorama:slug}/watch', [DoramaController::class, 'watch'])->name('watch');
    Route::get('/', [DoramaController::class, 'index'])->name('index');

    Route::middleware('auth')->group(function () {
        Route::patch('/{dorama:slug}/rating', [RatingController::class, 'addToDorama'])->name('rating.add');
        Route::delete('/{dorama:slug}/rating', [RatingController::class, 'removeToDorama'])->name('rating.remove');
        Route::patch('/{dorama:slug}/favorite', [FavoriteController::class, 'addToDorama'])->name('favorite.add');
        Route::delete('/{dorama:slug}/favorite', [FavoriteController::class, 'removeToDorama'])->name('favorite.remove');
    });
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    // ====FOLDERS====
    Route::prefix('folders')->name('folders.')->group(function () {
        Route::get('/', FolderController::class)->name('index');

        Route::prefix('animes')->name('animes.')->group(function () {
            Route::get('/', [AnimeFolderController::class, 'index'])->name('index');
            Route::get('/{folder}', [AnimeFolderController::class, 'show'])->name('show');
            Route::get('/create', [AnimeFolderController::class, 'create'])->name('create');
            Route::post('/', [AnimeFolderController::class, 'store'])->name('store');
            Route::get('/{folder}/edit', [AnimeFolderController::class, 'edit'])->name('edit');
            Route::patch('/{folder}', [AnimeFolderController::class, 'update'])->name('update');
            Route::delete('/{folder}', [AnimeFolderController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('doramas')->name('doramas.')->group(function () {
            Route::get('/', [DoramaFolderController::class, 'index'])->name('index');
            Route::get('/{folder}', [DoramaFolderController::class, 'show'])->name('show');
            Route::get('/create', [DoramaFolderController::class, 'create'])->name('create');
            Route::post('/', [DoramaFolderController::class, 'store'])->name('store');
            Route::get('/{folder}/edit', [DoramaFolderController::class, 'edit'])->name('edit');
            Route::patch('/{folder}', [DoramaFolderController::class, 'update'])->name('update');
            Route::delete('/{folder}', [DoramaFolderController::class, 'destroy'])->name('destroy');
        });
    });

    // ====SUBSCRIPTION====
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('/', function () {
            return 'Описание subscription';
        })->name('index');
    });

});

// ====ADMIN====
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', AdminPanelController::class)->name('index');

        Route::resource('/anime', AnimeAdminController::class)->except(['show', 'destroy']);
        Route::prefix('anime')->name('anime.')->group(function () {
            Route::get('/draft', [AnimeAdminController::class, 'draft'])->name('draft');
            Route::get('/published', [AnimeAdminController::class, 'published'])->name('published');
            Route::get('/archive', [AnimeAdminController::class, 'archive'])->name('archive');
            Route::get('/deleted', [AnimeAdminController::class, 'deleted'])->name('deleted');
            Route::get('/{anime:slug}/restore', [AnimeAdminController::class, 'restore'])->name('restore');

            Route::prefix('{anime}')->group(function () {
                Route::get('/', [AnimeAdminController::class, 'regenerateSlug'])->name('regenerateSlug');
                Route::resource('episodes', AnimeEpisodesAdminController::class)->except(['show']);
            });
        });

        Route::resource('/dorama', DoramaAdminController::class)->except(['show', 'destroy']);
        Route::prefix('dorama')->name('dorama.')->group(function () {
            Route::get('/draft', [DoramaAdminController::class, 'draft'])->name('draft');
            Route::get('/published', [DoramaAdminController::class, 'published'])->name('published');
            Route::get('/archive', [DoramaAdminController::class, 'archive'])->name('archive');
            Route::get('/deleted', [DoramaAdminController::class, 'deleted'])->name('deleted');
            Route::get('/{dorama:slug}/restore', [DoramaAdminController::class, 'restore'])->name('restore');

            Route::prefix('{dorama}')->group(function () {
                Route::get('/', [DoramaAdminController::class, 'regenerateSlug'])->name('regenerateSlug');
                Route::resource('episodes', DoramaEpisodesAdminController::class)->except(['show']);
            });
        });

        Route::resource('/types', TypeAdminController::class)->except(['show', 'destroy']);
        Route::resource('/genres', GenreAdminController::class)->except(['show', 'destroy']);
        Route::resource('/studios', StudiosAdminController::class)->except(['show', 'destroy']);
        Route::resource('/countries', CountriesAdminController::class)->except(['show', 'destroy']);
});
