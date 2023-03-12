<?php

use Illuminate\Support\Facades\Route;
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
    Route::get('/', function(){
        return view('Admin.home');
    })->name('admin.home');
    Route::prefix('category')->group(function () {
    
        Route::get('/',[CategoryController::class,'list'])
        ->name('admin.category.list');
    
        Route::get('/create',[CategoryController::class,'create'])
        ->name('admin.category.create');
        
        Route::post('/store',[CategoryController::class,'store'])
        ->name('admin.category.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])
        ->name('admin.category.edit');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])
        ->name('admin.category.delete');
    });
    
       
        
    

});

