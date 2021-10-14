<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


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

// middlewareを適用するURLをグループ化
Route::group(['prefix' => 'todo', 'middleware' => ['auth', 'web']], function(){
    Route::get('/', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/show/{id}', [TodoController::class, 'show'])->name('todo.show');
    Route::get('/create', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/create', [TodoController::class, 'store'])->name('todo.store');
});