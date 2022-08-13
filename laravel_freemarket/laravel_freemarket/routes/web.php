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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'SingleAction')->name('single.top');

Route::get('/profile/{user}/edit_image', 'ProfileController@editImage')->name('profile.edit_image');

Route::get('/goods/{id}/edit_image', 'GoodsController@editImage')->name('goods.edit_image');

Route::get('/items/{id}/toggle_like', 'GoodsController@toggleLike')->name('goods.toggle_like');

Route::get('/purchase/{id}/confirmation', 'GoodsController@indexOrder')->name('purchase.index');

Route::post('/purchase/{id}/buy', 'GoodsController@buy')->name('purchase.create');

Route::patch('/profile/{user}/edit_image', 'ProfileController@updateImage')->name('profile.update_image');

Route::patch('/goods/{id}/edit_image', 'GoodsController@updateImage')->name('goods.update_image');

Route::patch('/items/{id}/toggle_like', 'GoodsController@toggleLike')->name('goods.toggle_like');

Route::resource('profile', 'ProfileController')->only([
    'index', 'edit', 'update'
]);

Route::resource('goods', 'GoodsController');

Route::patch('/purchase/{id}/confirmation', 'GoodsController@indexOrder')->name('purchase.index');
    
Route::resource('likes', 'LikeController')->only([
    'index', 'store', 'destroy'
]);