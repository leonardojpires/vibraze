<?php

use App\Http\Controllers\BandsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

# Routes for HomeController

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::fallback([HomeController::class, 'fallback']);


# Routes for BandsController
Route::get('/list-bands', [BandsController::class, 'listBands'])->name('bands.list')->middleware('auth');

Route::get('/show-band/{bandId}', [BandsController::class, 'showBand'])->name('bands.show')->middleware('auth');

Route::get('/add-band', [BandsController::class, 'addBandView'])->name(name: 'bands.add')->middleware(['auth', 'admin']);

Route::post('/create-band', [BandsController::class, 'storeBand'])->name('bands.store')->middleware(['auth', 'admin']);

Route::put('/update-band/{bandId}', [BandsController::class, 'updateBand'])->name('bands.update')->middleware(['auth', 'admin']);

Route::delete('/delete-band/{bandId}', [BandsController::class, 'deleteBand'])->name('bands.remove')->middleware(['auth', 'admin']);


# Routes for FavoritesController
Route::get('/favorite-bands', [FavoritesController::class, 'favoriteBandsView'])->name('favorites.list')->middleware('auth');

Route::post('/favorite-bands/{bandId}', [FavoritesController::class, 'favoriteBands'])->name('favorites.add')->middleware('auth');

Route::delete('/favorite-bands/{bandId}', [FavoritesController::class, 'removeFavorites'])->name('favorites.remove')->middleware('auth');


# Routes for GenresController
Route::get('/add-genre', [GenresController::class, 'addGenresView'])->name('genres.add')->middleware(['auth', 'admin']);

Route::post('/create-genre', [GenresController::class, 'storeGenre'])->name('genres.store')->middleware(['auth', 'admin']);


# Routes for UserController
Route::get('/registration', [UserController::class, 'addUserView'])->name('users.add');

Route::get('/login', [UserController::class, 'loginView'])->name('login');

Route::post('/create-user', [UserController::class, 'storeUser'])->name('users.store');

Route::post('/logout', [UserController::class, 'logout'])->name('users.logout')->middleware('auth');;

Route::post('/login-user', [UserController::class, 'login'])->name('login.store');
