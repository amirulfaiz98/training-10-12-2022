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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'articles',
    'as' => 'articles.',
], function () {
    Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('create');
    Route::post('/create', [App\Http\Controllers\ArticleController::class, 'store'])->name('store');
    Route::get('/{article}', [App\Http\Controllers\ArticleController::class, 'show'])->name('show');
    Route::get('/{article}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->name('edit');
    Route::post('/{article}/edit', [App\Http\Controllers\ArticleController::class, 'update'])->name('update');
    Route::get('/{article}/delete', [App\Http\Controllers\ArticleController::class, 'delete'])->name('delete');
});
