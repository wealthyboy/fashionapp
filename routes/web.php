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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/posts', 'PostController@index');
Route::get('/post/new', 'PostController@create');
Route::post('/photo/store', 'PhotoController@store');
Route::post('/post/store', 'PostController@store');
Route::get('/post/{slug}', 'PostController@show');
Route::put('/labels/create', 'ImageLabelController@create');
Route::get('/label', 'ImageLabelController@index');

/*ACCOUNT ROUTES*/

Route::get('/myaccount', 'AccountController@index');
Route::post('/editaccount', 'AccountController@editaccount');
Route::get('/changepassword', 'AccountController@changepassword');
Route::post('/changepassword', 'AccountController@changepassword');


/*ACCOUNT ROUTES ENDS*/


