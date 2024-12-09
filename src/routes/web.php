<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [TodoController::class, 'index']);

Route::prefix('todos')->group(function () {
    Route::get('/search', [TodoController::class, 'search']);
    Route::post('/create', [TodoController::class, 'store']);
    Route::patch('/update', [TodoController::class, 'update']);
    Route::delete('/delete', [TodoController::class, 'destroy']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/create', [CategoryController::class, 'store']);
    Route::patch('/update', [CategoryController::class, 'update']);
    Route::delete('/delete', [CategoryController::class, 'destroy']);
});