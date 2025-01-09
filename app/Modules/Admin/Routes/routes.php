<?php

/*
|--------------------------------------------------------------------------
| Manager Module Routes
|--------------------------------------------------------------------------
|
| Here you can add routes that belongs to Manager module
| Only make sure not to add any routes that does not belong here in
| Manager Module ...
|
*/


use App\Modules\Admin\Controllers\IndexController;
use App\Modules\Admin\Controllers\OperationController;
use App\Modules\Admin\Controllers\OrderController;
use App\Modules\Admin\Controllers\ProductController;
use App\Modules\Admin\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth'
    ], function(){
    Route::name('admin.')->prefix('admin')->group( function (){

        Route::get('dashboard', [IndexController::class, 'dashboard'])->name('dashboard'); 

        Route::controller(StaffController::class)->prefix('staff')->name('staff.')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::get('types', 'types')->name('types');
            Route::post('typestore', 'typestore')->name('typestore');
            Route::put('typeupdate/{type}', 'typeupdate')->name('typeupdate');
            Route::post('store', 'store')->name('store');
            Route::put('update/{staff}', 'update')->name('update');
        }); 

        Route::controller(OperationController::class)->prefix('operation')->name('operation.')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::post('income/{staff}', 'income')->name('income');
            Route::post('outcome/{staff}', 'outcome')->name('outcome');
            Route::get('incomes', 'incomes')->name('incomes');
            Route::get('outcomes', 'outcomes')->name('outcomes');
            Route::get('history/{staff}', 'history')->name('history');
            Route::get('order/{staff}', 'order')->name('order');
        }); 


        Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function (){
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::put('update/{product}', 'update')->name('update');
        }); 

        Route::controller(OrderController::class)->prefix('order')->name('order.')->group(function (){
            Route::post('store/{staff}', 'store')->name('store');
        }); 
    });
});
