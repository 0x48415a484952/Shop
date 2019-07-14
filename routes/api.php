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
Route::resource('mylists', 'Mylists\MylistController');
Route::post('addItemToList', 'Mylists\MylistController@addItemToList');
Route::resource('products', 'Products\ProductController');
Route::get('productIndexForAdmin', 'Products\ProductController@productIndexForAdmin');
// Route::get('getRandomProducts', 'Products\ProductController@getRandomProducts');
Route::resource('productvariationtypes', 'ProductVariationType\ProductVariationTypeController');
Route::resource('productvariations', 'ProductVariation\ProductVariationController');
Route::resource('addresses', 'Addresses\AddressController');
Route::resource('provinces', 'Provinces\ProvinceController');
Route::resource('cities', 'Cities\CityController');
Route::resource('comments', 'Comments\CommentController');
Route::resource('sliders', 'Sliders\SliderController');
Route::resource('shippingmethods', 'ShippingMethods\ShippingMethodController');
Route::resource('orders', 'Orders\OrderController');
Route::get('orderIndexForAdmin', 'Orders\OrderController@orderIndexForAdmin');

Route::get('search', 'SearchController@action');

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', 'Auth\RegisterController@action');
    // Route::options('register', 'Auth\RegisterController@action');
    Route::get('register', 'Auth\RegisterController@action');
    Route::patch('confirm', 'Auth\PhoneVerificationController@action');
    Route::post('login', 'Auth\LoginController@action');
    Route::post('logout', 'Auth\LogoutController@action');
    Route::get('me', 'Auth\MeController@action');
    Route::post('profilestore', 'Auth\ProfileStoreController@action');
    Route::post('forgotpassword', 'Auth\ForgotPasswordController@action');
});

// Route::get('profile', 'Profile\ProfileController@me');
// Route::post('profile', 'Profile\ProfileController@store');

route::resource('cart', 'Cart\CartController', [
    'parameters' => [
        'cart' => 'productVariation'
    ]
]);




Route::group(['middleware' => ['jwt.verify', 'role.authorization']], function() {
    // Route::get('product/create', 'ProductController@create');
    // Route::get('category/product/{product}', 'ProductController@removeCategory');
    // Route::post('category', 'CategoryController@store');
    // Route::post('category{category}/edit', 'CategoryController@edit');
    // Route::put('category', 'CategoryController@update');
    // Route::delete('category/{category}', 'CategoryController@destroy');
});

//pay.ir routes	
Route::get('transactions', 'Transactions\TransactionController@index');
Route::post('transactions', 'Transactions\TransactionController@store');
Route::get('transactions/callback', 'Transactions\TransactionController@callback');


