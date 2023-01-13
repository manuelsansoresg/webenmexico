<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();
Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('comment', [App\Http\Controllers\HomeController::class, 'comment']);
Route::resource('admincomment', App\Http\Controllers\CommentController::class);
Route::get('admincomment/{id}/comment/delete', [App\Http\Controllers\CommentController::class, 'destroy']);
