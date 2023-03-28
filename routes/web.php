<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainClientController;
use App\Http\Controllers\MenuClientController;

Route::get('/admin/users/login',[LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store',[LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () { //middleware auth sẽ kiểm tra đăng nhập, chưa đăng nhập đưa về login, group để group các link route lại
    
    Route::prefix('admin')->group(function () {
        Route::get('main', [MainController::class, 'index'])->name('admin');

        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);

            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
        });

        Route::prefix('products')->group(function() {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index'])->name('dsSP');
            Route::get('edit/{product}',[ProductController::class, 'show']);
            Route::post('edit/{product}',[ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        Route::prefix('sliders')->group(function() {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}',[SliderController::class, 'show']);
            Route::post('edit/{slider}',[SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #upload
        Route::POST('upload/services',[UploadController::class, 'store']);
    });

    
});

Route::get('/', [MainClientController::class, 'index']);


Route::POST('/services/load-product', [MainClientController::class, 'LoadMoreProduct']);

Route::get('/danh-muc/{id}-{slug}.html',[MenuClientController::class,'index']);

Route::get('/san-pham/{id}-{slug}.html',[App\Http\Controllers\ProductController::class, 'index']);

Route::POST('add-cart',[CartController::class, 'index']);

Route::get('carts',[CartController::class, 'show']);

Route::POST('update_cart', [CartController::class, 'update']);

Route::get('carts/delete/{id}', [CartController::class, 'remove']);

Route::POST('carts', [CartController::class, 'addCart']);