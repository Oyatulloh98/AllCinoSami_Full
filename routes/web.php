<?php

use App\Http\Controllers\AllCinoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmRuVideoController;
use App\Http\Controllers\FilmUzVideoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\SerialRuVideoController;
use App\Http\Controllers\SerialUzVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::controller(AllCinoController::class)->group(function () {
    Route::get('/', 'index')->name('AllCino.index');
    Route::get('/view_film_video/{id}', 'view_film_video')->name('AllCino_Film_Video.view');
    Route::get('/view_serial_video/{id}', 'view_serial_video')->name('AllCino_Serial_Video.view');
});

Route::controller(PageController::class)->group(function () {
    Route::get('Admin-Panel', 'index')->name('Admin-Panel.index');
});

// This here categories start
Route::controller(CategoryController::class)->group(function () {
    Route::get('/catdeletes',                'catdeletes')->name('category.deletes');
    Route::post('/recategory/{id}',          'recategory')->name('category.restore');
    Route::post('/forcedeletecategory/{id}', 'forcedelete')->name('category.forcedelete');
    Route::resource('/category', CategoryController::class);
});
// This here categories route end

// This here brands route start
Route::controller(BrandController::class)->group(function () {
    Route::get('/branddeletes',           'branddeletes')->name('brand.deletes');
    Route::post('/rebrand/{id}',          'rebrand')->name('brand.restore');
    Route::post('/forcedeletebrand/{id}', 'forcedelete')->name('brand.forcedelete');
    Route::resource('/brand', BrandController::class);
});
// This here brands route  end

// This here Serial route start
Route::controller(SerialController::class)->group(function () {
    Route::get('/get-brands-by-category', 'getBrandsByCategory')->name('getBrandsByCategory');
    Route::get('/serialdeletes',       'allserialdeletes')->name('serial.deletes');
    Route::post('/reserials/{id}',        'reserials')->name('serial.rejoin');
    Route::post('/undo/{id}',             'undoSerial')->name('serial.undo');
    Route::resource('/serial', SerialController::class);
});
// This here Serial route end

// This here Film route start
Route::controller(FilmController::class)->group(function () {
    Route::delete('/film_one_delete_store/{id}', 'film_one_delete_store')->name('films.delete');
    Route::get('/films_is_deleted', 'films_is_deleted')->name('films.deleted');
    Route::get('/films_restore/{id}', 'films_restore')->name('films.restore');
    Route::post('/remove_film', 'films_remove')->name('films.remove');
    Route::resource('/films', FilmController::class);
});
// This here Film route start

// This here SerialUzVideo route start
Route::controller(SerialUzVideoController::class)->group(function () {
    Route::get('/uz_serial_index/{id}',  'uz_serial_index')->name('UzbekSerialVideo.index');
    Route::get('/uz_serial_create/{id}', 'uz_serial_create')->name('UzbekSerialVideo.create');
    Route::post('/uz_serial_store/{id}', 'uz_serial_store')->name('UzbekSerialVideo.store');
    Route::get('/uz_serial_edit/{id}',   'uz_serial_edit')->name('UzbekSerialVideo.edit');
    Route::put('/uz_serial_update/{id}', 'uz_serial_update')->name('UzbekSerialVideo.update');
});
// This here SerialUzVideo route end

// This here SerialRuVideo route start
Route::controller(SerialRuVideoController::class)->group(function () {
    Route::get('/ru_serial_index/{id}',  'ru_serial_index')->name('RussianSerialVideo.index');
    Route::get('/ru_serial_create/{id}', 'ru_serial_create')->name('RussianSerialVideo.create');
    Route::post('/ru_serial_store/{id}', 'ru_serial_store')->name('RussianSerialVideo.store');
    Route::get('/ru_serial_edit/{id}',   'ru_serial_edit')->name('RussianSerialVideo.edit');
    Route::put('/ru_serial_update/{id}', 'ru_serial_update')->name('RussianSerialVideo.update');
});
// This here SerialRuVideo route end

// This here FilmUzVideo route start
Route::controller(FilmUzVideoController::class)->group(function () {
    Route::get('/uz_film_index/{id}',  'uz_film_index')->name('UzbekFilmVideo.index');
    Route::get('/uz_film_create/{id}', 'uz_film_create')->name('UzbekFilmVideo.create');
    Route::post('/uz_film_store/{id}', 'uz_film_store')->name('UzbekFilmVideo.store');
    Route::get('/uz_film_edit/{id}',   'uz_film_edit')->name('UzbekFilmVideo.edit');
    Route::put('/uz_film_update/{id}',   'uz_film_update')->name('UzbekFilmVideo.update');
});
// This here FilmUzVideo route end

// This here FilmRuVideo route start
Route::controller(FilmRuVideoController::class)->group(function () {
    Route::get('/ru_film_index/{id}',  'ru_film_index')->name('RussianFilmVideo.index');
    Route::get('/ru_film_create/{id}', 'ru_film_create')->name('RussianFilmVideo.create');
    Route::post('/ru_film_store/{id}', 'ru_film_store')->name('RussianFilmVideo.store');
    Route::get('/ru_film_edit/{id}',   'ru_film_edit')->name('RussianFilmVideo.edit');
    Route::put('/ru_film_update/{id}', 'ru_film_update')->name('RussianFilmVideo.update');
});
// This here FilmRuVideo route end

