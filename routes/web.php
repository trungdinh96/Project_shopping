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
        
    

    });
    
       
        
    

});

