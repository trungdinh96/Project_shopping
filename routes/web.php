<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;

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

Route::middleware('auth','can:is-admin')
    ->prefix('admin')->group(function () {

        Route::get('/', function () {
            return view('Admin.home');
        })->name('admin.home');
        Route::prefix('category')->group(function () {

            Route::get('/', [CategoryController::class, 'list'])
                ->name('admin.category.list')->middleware('can:category-list');

            Route::get('/create', [CategoryController::class, 'create'])
                ->name('admin.category.create')->middleware('can:category-create');

            Route::post('/store', [CategoryController::class, 'store'])
                ->name('admin.category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])
                ->name('admin.category.edit')->middleware('can:category-edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])
                ->name('admin.category.update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])
                ->name('admin.category.delete')->middleware('can:category-edit');
                Route::get('/listSoft', [CategoryController::class, 'showSoftDelete'])
                ->name('admin.category.deletesoft');
            Route::get('/restore/{id}', [CategoryController::class, 'restoreCategory'])
                ->name('admin.category.restore');
            Route::get('/deleteTrash/{id}', [CategoryController::class, 'deleteTrash'])
                ->name('admin.category.deleteTrash');
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
        Route::prefix('product')->group(function () {

            Route::get('/', [ProductController::class, 'listProducts'])
                ->name('admin.product.list')->middleware('can:product-list');

            Route::get('/create', [ProductController::class, 'createProduct'])
                ->name('admin.product.create')->middleware('can:product-create');

            Route::post('/store', [ProductController::class, 'store'])
                ->name('admin.product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])
                ->name('admin.product.edit')->middleware('can:product-edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])
                ->name('admin.product.update');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])
                ->name('admin.product.delete')->middleware('can:product-delete');
            Route::get('/listSoft', [ProductController::class, 'showSoftDelete'])
                ->name('admin.product.deletesoft');
            Route::get('/restore/{id}', [ProductController::class, 'restoreProduct'])
                ->name('admin.product.restore');
            Route::get('/deleteTrash/{id}', [ProductController::class, 'deleteTrash'])
                ->name('admin.product.deleteTrash');
        });
        Route::prefix('users')->group(function () {

            Route::get('/', [UserController::class, 'list'])
                ->name('admin.user.list')->middleware('can:user-list');

            Route::get('/create', [UserController::class, 'create'])
                ->name('admin.user.create')->middleware('can:user-create');

            Route::post('/store', [UserController::class, 'store'])
                ->name('admin.user.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])
                ->name('admin.user.edit')->middleware('can:user-edit');
            Route::post('/update/{id}', [UserController::class, 'update'])
                ->name('admin.user.update');
            Route::get('/delete/{id}', [UserController::class, 'delete'])
                ->name('admin.user.delete')->middleware('can:user-delete');
            Route::get('/listSoft', [UserController::class, 'showSoftDelete'])
                ->name('admin.user.deletesoft');
            Route::get('/restore/{id}', [UserController::class, 'restoreUser'])
                ->name('admin.user.restore');
            Route::get('/deleteTrash/{id}', [UserController::class, 'deleteTrash'])
                ->name('admin.user.deleteTrash');
        });
        Route::prefix('permission')->group(function () {

            Route::get('/', [PermissionController::class, 'list'])
                ->name('admin.permission.list')->middleware('can:permission-list');

            Route::get('/create', [PermissionController::class, 'create'])
                ->name('admin.permission.create')->middleware('can:permission-create');

            Route::post('/store', [PermissionController::class, 'store'])
                ->name('admin.permission.store');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])
                ->name('admin.permission.edit')->middleware('can:permission-edit');
            Route::post('/update/{id}', [PermissionController::class, 'update'])
                ->name('admin.permission.update');
            Route::get('/delete/{id}', [PermissionController::class, 'delete'])
                ->name('admin.permission.delete')->middleware('can:permission-delete');
            // Route::get('/listSoft', [PermissionController::class, 'showSoftDelete'])
            //     ->name('admin.permission.deletesoft');
            // Route::get('/restore/{id}', [PermissionController::class, 'restoreUser'])
            //     ->name('admin.permission.restore');
            // Route::get('/deleteTrash/{id}', [PermissionController::class, 'deleteTrash'])
            //     ->name('admin.permission.deleteTrash');
        });
    });

Route::prefix('/')->group(function(){
    Route::get('/',[HomeController::class, 'index'])->name('client.index');
    Route::get('/logout',[AdminController::class, 'logout'])->name('logout');
});
require __DIR__ . '/auth.php';
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


