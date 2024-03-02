<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmRuVideoController;
use App\Http\Controllers\FilmUzVideoController;
use App\Http\Controllers\SerialRuVideoController;
use App\Http\Controllers\SerialUzVideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('select_brand', [FilmController::class, 'select_brand']);

// This here SerialUZVideoController api route start
Route::controller(SerialUzVideoController::class)->group(function () {
    Route::get('serial_uzbek_video_suitable_recipient', 'serial_uzbek_video_suitable_recipient');
    Route::get('serial_uzbek_video_for_update_get_part', 'serial_uzbek_video_for_update_get_part');
    Route::get('serial_uzbek_video_remuve_or_put', 'serial_uzbek_video_remuve_or_put');
    Route::get('serial_uzbek_video_compolately_destroy', 'serial_uzbek_video_compolately_destroy');
});
// This here SerialUZVideoController api route end

// This here SerialRuVideoController api route start
Route::controller(SerialRuVideoController::class)->group(function () {
    Route::get('serial_russian_video_suitable_recipient', 'serial_russian_video_suitable_recipient');
    Route::get('serial_russian_video_remuve_or_put', 'serial_russian_video_remuve_or_put');
    Route::get('serial_russian_video_compolately_destroy', 'serial_russian_video_compolately_destroy');
    Route::get('serial_russian_video_for_update_get_part', 'serial_russian_video_for_update_get_part');
});
// This here SerialRuVideoController api route end

// This here FilmUzVideoController api_route start
Route::controller(FilmUzVideoController::class)->group(function () {
    Route::get('film_uzbek_video_suitable_recipient', 'film_uzbek_video_suitable_recipient');
    Route::get('film_uzbek_video_remuve_or_put', 'film_uzbek_video_remuve_or_put');
    Route::get('film_uzbek_video_compolately_destroy', 'film_uzbek_video_compolately_destroy');
    Route::get('film_uzbek_video_for_update_get_part', 'film_uzbek_video_for_update_get_part');
});
// This here FilmUzVideoController api_route end

// This here FilmRuVideoController api route start
Route::controller(FilmRuVideoController::class)->group(function () {
    Route::get('russion_video_compolately_destroy', 'russion_video_compolately_destroy');
    Route::get('russion_video_remove_put', 'russion_video_remove_put');
    Route::get('russion_video_suitable_recipient', 'russion_video_suitable_recipient');
    Route::get('russion_video_for_update_get_part', 'russion_video_for_update_get_part');
});
// This here FilmRuVideoController api route end
