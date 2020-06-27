<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes(['reset' => false, 'verify' => false]);

Route::get('/', 'TopController@index');
Route::get('contact', 'WelcomeController@contact');
Route::get('about', 'PagesController@about');
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/mylist', 'MylistController@index')->name('mylist');
    Route::get('/new/{post}', 'ListsController@show');
    Route::get('/list', 'AllListsController@index');
    Route::get('/reply/{post_number:post_number}', 'CommentController@show');
});
Route::post('/new/{post}', 'ListsController@match');
Route::resource('reply', 'CommentController', ['only' => ['store','update', 'destroy']]);
Route::resource('lists', 'ListsController', ['only' => ['store', 'show', 'update', 'destroy']]);
Route::resource('posts', 'PostsController', ['only' => ['store', 'update', 'destroy']]);
Route::get('/share/{post}', 'ShareController@show');
Route::resource('share', 'ShareController', ['only' => ['update']]);