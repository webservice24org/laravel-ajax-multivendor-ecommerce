<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.index');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //Routes for todo lists
    Route::resource('todos', TodoController::class);
    Route::post('todos/mark-completed', [TodoController::class,'markCompleted'])->name('todos.mark-completed');
    Route::post('todos/bulk-delete', [TodoController::class, 'bulkDelete'])->name('todos.bulk-delete');
    
    Route::resource('categories', NewsCategoryController::class);
    Route::post('categories/bulk-delete', [NewsCategoryController::class, 'bulkCatDelete'])->name('categories.bulk-delete');
    
    Route::resource('brands', BrandController::class);
    Route::post('brands/bulk-delete', [BrandController::class, 'bulkBrandDelete'])->name('brands.bulk-delete');
    
    Route::resource('product-categories', ProductCategoryController::class);
    Route::post('product-categories/bulk-delete', [ProductCategoryController::class, 'bulkpCatDelete'])->name('pcat.bulk-delete');
   
    Route::resource('departments', DepartmentController::class);
    Route::post('departments/bulk-delete', [DepartmentController::class, 'bulkDepDelete'])->name('dep.bulk-delete');
    

});    



// Route::group(['middleware' => ['auth', 'admin']], function () {
// });

// Route::group(['middleware' => ['auth', 'vendor']], function () {
// });


// Route::group(['middleware' => ['auth', 'customer']], function () {

// });

