<?php

use App\Http\Controllers\BandsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

# Routes for HomeController

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::fallback([HomeController::class, 'fallback']);

# Routes for BandsController

Route::get('/list-bands', [BandsController::class, 'listBands'])->name('bands.list');

Route::get('/show-band/{bandId}', [BandsController::class, 'showBand'])->name('bands.show');

Route::get('/add-band', [BandsController::class, 'addBandView'])->name('bands.add');

Route::post('/create-band', [BandsController::class, 'storeBand'])->name('bands.store');

# Routes for FavoritesController
Route::get('/favorite-bands', [FavoritesController::class, 'favoriteBandsView'])->name('favorites.list');

Route::post('/favorite-bands/{bandId}', [FavoritesController::class, 'favoriteBands'])->name('favorites.add');

Route::delete('/favorite-bands/{bandId}', [FavoritesController::class, 'removeFavorites'])->name('favorites.remove');

# Routes for GenresController
Route::get('/add-genre', [GenresController::class, 'addGenresView'])->name('genres.add');

Route::post('/create-genre', [GenresController::class, 'storeGenre'])->name('genres.store');
