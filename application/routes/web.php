<?php

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

/**
 * フロントサイド
 */
Route::namespace('Front')->name('front.')->group(function () {
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('products', 'ProductController', [
        'only' => [
            'index',
            'show',
        ]
    ]);

    Route::post('wish_products/{product}', 'WishProductController@store');
    Route::delete('wish_products/{product}', 'WishProductController@destroy');

    Route::middleware('auth')->group(function () {
        Route::resource('users', 'UserController', [
            'only' => [
                'edit',
                'update',
            ]
        ]);
        Route::resource('products.product_reviews', 'ProductReviewController', [
            'except' => [
                'index',
                'show',
                'destroy',
            ]
        ]);
    });
});

/**
 * 管理サイド
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::middleware('auth:admin')->group(function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::resources([
            'products' => 'ProductController',
            'users' => 'UserController',
            'product_categories' => 'ProductCategoryController',
            'admin_users' => 'AdminUserController',
        ]);
    });
});

/**
 * リダイレクト
 */
Route::redirect('/', '/home');
Route::redirect('/admin', '/admin/home');
