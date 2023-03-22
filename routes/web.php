<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
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

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'loginAdmin']);
    Route::post('/', [AdminController::class, 'postLoginAdmin'])->name('admin');
    Route::get('/home', function () {
        return view('Admin.home');
    })->name('admin.home');
    Route::prefix('category')->group(function () {

        Route::get('/', [CategoryController::class, 'list'])
            ->name('admin.category.list');

        Route::get('/create', [CategoryController::class, 'create'])
            ->name('admin.category.create');

        Route::post('/store', [CategoryController::class, 'store'])
            ->name('admin.category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])
            ->name('admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])
            ->name('admin.category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])
            ->name('admin.category.delete');
    });
    Route::prefix('menu')->group(function () {

        Route::get('/', [MenuController::class, 'list'])
            ->name('admin.menu.list');

        Route::get('/create', [MenuController::class, 'create'])
            ->name('admin.menu.create');

        Route::post('/store', [MenuController::class, 'store'])
            ->name('admin.menu.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])
            ->name('admin.menu.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])
            ->name('admin.menu.update');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])
            ->name('admin.menu.delete');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
