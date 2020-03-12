<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', function () {
    return redirect(route('canvases.index'));
})->name('welcome');

Route::get('/', function () {
    return redirect(route('home'));
})->name('root');

Route::resource('boards', 'BoardController')->middleware('auth');
Route::group(['prefix' => 'boards'], function () {
    Route::get('/{id}/delete', 'BoardController@delete')->name('boards.delete')->middleware('auth');
});

Route::resource('canvases', 'CanvasController')->middleware('auth');
Route::group(['prefix' => 'canvases'], function () {
    Route::get('/{id}/delete', 'CanvasController@delete')->name('canvases.delete')->middleware('auth');
    Route::put('/{canvas_id}/cards/{card_id}/cardvalues', 'CardValueController@store')->name('canvases.edit.cardvalues.store')->middleware('auth');
    Route::get('/{canvas_id}/cards/{card_id}/cardvalues/{value_order}', 'CardValueController@delete')->name('canvases.edit.cardvalues.delete')->middleware('auth');
    Route::delete('/{canvas_id}/cards/{card_id}/cardvalues/{value_order}', 'CardValueController@destroy')->name('canvases.edit.cardvalues.destroy')->middleware('auth');
});


?>
