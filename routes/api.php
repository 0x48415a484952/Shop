<?php
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
/*
===================>this are working ones that i have commented below<================================
Route::post('user/register', 'UserController@register');
Route::post('user/login', 'UserController@authenticate');
Route::get('open', 'DataController@open');
route::post('user/forgotPassword', 'UserController@forgotPassword');

Route::group(['middleware' => ['jwt.verify', 'api.header']], function() {
    Route::post('user/sendVerificationCodeAgain', 'UserController@SendVerificationCodeAgain');
    Route::put('user/confirm', 'UserController@confirm');
    Route::put('user/changePhone', 'UserController@changePhone');
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@close');
});

Route::get('product/{product}', 'ProductController@show');
Route::get('category', 'CategoryController@index');
Route::get('category/makePath/{category}', 'CategoryController@makePath');
Route::get('category/{category}', 'CategoryController@show');

Route::group(['middleware' => ['jwt.verify', 'role.authorization']], function() {
    Route::get('product/create', 'ProductController@create');
    Route::get('category/product/{product}', 'ProductController@removeCategory');
    Route::post('category', 'CategoryController@store');
    Route::post('category{category}/edit', 'CategoryController@edit');
    Route::put('category', 'CategoryController@update');
    Route::delete('category/{category}', 'CategoryController@destroy');
});
*/


Route::resource('categories', 'Categories\CategoryController');
Route::resource('products', 'Products\ProductController');
Route::resource('addresses', 'Addresses\AddressController');
Route::resource('provinces', 'Provinces\ProvinceController');
Route::resource('cities', 'Cities\CityController');

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'Auth\RegisterController@action');
    Route::post('login', 'Auth\LoginController@action');
    Route::get('me', 'Auth\MeController@action');
});

route::resource('cart', 'Cart\CartController', [
    'parameters' => [
        'cart' => 'productVariation'
    ]
]);

