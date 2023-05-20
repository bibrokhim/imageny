<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
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

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function() {
    Route::get('/', HomeController::class)->name('home');

    Route::resource('folders', FolderController::class);

    Route::get('images/{image}', [ImageController::class, 'show'])->name('images.show');
    Route::put('images/{image}', [ImageController::class, 'update'])->name('images.update');
    Route::post('images/upload/folder/{folder}', [ImageController::class, 'upload'])->name('images.upload');
    Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

    Route::get('files', [FileController::class, 'index'])->name('files.index');
    Route::post('files/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::put('files/{file}', [FileController::class, 'update'])->name('files.update');
    Route::delete('files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    Route::resource('users', UserController::class)->middleware('can:manage-user');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

