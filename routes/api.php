<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::group(['namespace' => 'Like', 'prefix'=>'{post}/Alikes'], function (){
        Route::post('/','StoreController')->name('post.Alike.store');
    });
});
Route::group(['namespace' => 'Vue', 'prefix' => 'vue'], function(){
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::group(['namespace' => 'User','prefix' => 'users'],function (){
            Route::get('/','IndexController')->name('vue.admin.user.index');
            Route::delete('/{user}','DeleteController')->name('vue.admin.user.delete');
            Route::patch('/{user}','UpdateController')->name('vue.admin.user.update');
            Route::post('/', 'StoreController')->name('vue.admin.user.store');
        });
        Route::group(['namespace' => 'Category','prefix' => 'category'],function (){
            Route::get('/','IndexController')->name('vue.admin.category.index');
            Route::delete('/{category}','DeleteController')->name('vue.admin.category.delete');
            Route::patch('/{category}','UpdateController')->name('vue.admin.category.update');
            Route::post('/', 'StoreController')->name('vue.admin.category.store');
        });

        Route::group(['namespace' => 'Post','prefix' => 'post'],function (){
            Route::get('/','IndexController')->name('vue.admin.post.index');
            Route::delete('/{post}','DeleteController')->name('vue.admin.post.delete');
            Route::patch('/{post}','UpdateController')->name('vue.admin.post.update');
            Route::post('/store', 'StoreController')->name('vue.admin.post.store');
        });
        Route::group(['namespace' => 'Tag','prefix' => 'tag'],function (){
            Route::get('/','IndexController')->name('vue.admin.tag.index');
            Route::delete('/{tag}','DeleteController')->name('vue.admin.tag.delete');
            Route::patch('/{tag}','UpdateController')->name('vue.admin.tag.update');
            Route::post('/', 'StoreController')->name('vue.admin.tag.store');
        });
    });
});
