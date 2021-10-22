<?php

use App\Http\Controllers\MusicaController;
use Illuminate\Support\Facades\Route;

Route::get('/spotify/artistas', [MusicaController::class, 'getArtistas']);
Route::get('/spotify/discografia-by-banda', [MusicaController::class, 'getDiscografia']);
