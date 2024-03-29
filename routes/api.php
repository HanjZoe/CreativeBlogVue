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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

    Route::group(['namespace' => 'Vue', 'prefix' => 'vue'], function () {
        Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
            Route::post('/posts', 'IndexController');
            Route::post('/post/{post}', 'IndexController@show');
            Route::post('/category/{category}', 'IndexController@categry');
            Route::get('/user', 'IndexController@user')->middleware('api');

                Route::group(['prefix'=>'{post}/likes'], function (){
            Route::post('/', 'IndexController@like')->middleware('auth:api');
        });

            Route::group(['prefix'=>'{post}/comments'], function () {
                Route::post('/', 'IndexController@comment')->middleware('jwt.auth');
        });
        });
        Route::group(['namespace' => 'Personal', 'prefix' => 'personal'], function () {
            Route::post('/', 'IndexContrller')->middleware('jwt.auth');
            Route::post('/like', 'LikeController')->middleware('jwt.auth');
            Route::delete('/like/{post}', 'LikeController@delete')->middleware('jwt.auth');
            Route::post('/comment', 'CommentController')->middleware('jwt.auth');
            Route::delete('/comment/{comment}', 'CommentController@delete')->middleware('jwt.auth');
            Route::patch('/comment/{comment}', 'CommentController@update')->middleware('jwt.auth');
    });
    });


Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::group(['namespace' => 'Like', 'prefix'=>'{post}/likes'], function (){
        Route::post('/','StoreController')->name('post.Alike.store');
    });
});
Route::group(['namespace' => 'Vue', 'prefix' => 'vue'], function(){
   Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
        Route::post('/reg', 'StoreController')->name('vue.registration');
    });

   Route::group(['middleware' => 'jwt.auth'], function (){



       Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
           Route::group(['namespace' => 'Main'],function () {
               Route::get('/', 'IndexController');
           });
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
               Route::get('/{post}','EditController')->name('vue.admin.post.edit');
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



});
