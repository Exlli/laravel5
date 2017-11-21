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

//Route::get('/', function () {
//    return view('welcome');
//});

/*
Route::get('get1', function () {
    return "get1";
});

Route::get('get2/{name?}', function ($name = null) {
    return "get2-".$name;
});

Route::get('user/{id}/{name}', function ($id,$name) {
    return "user-id".$id."-name-".$name;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);*/

//Route::get('user/{id}', 'UserController@show');
//
//Route::get('blade', function () {
//   return view('child1');
//});
//
//Route::get('alert', function () {
//   return view('welcome', ['name' => 'Samantha']);
//});

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(
    ['as' => 'web:'],
    function(){
        Route::group(
            [],
            function(){
                Route::post('logout', 'Auth\LoginController@logout')
                    ->name('logout');
            }
        );

        Route::group(
            ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],
            function() {
                Route::get('/', 'AdminHomeController@index');
                Route::resource('pages', 'PagesController');
                Route::resource('comments', 'CommentsController');
                Route::resource('articles',
                    'ArticlesController',
                    ['only'=>['index', 'show', 'create', 'edit', 'update']]
                );
            }
        );


    }
);

Route::get('/admin/pages/{id}', 'Admin\PagesController@show');


Route::post('comment/store', 'CommentsController@store');
