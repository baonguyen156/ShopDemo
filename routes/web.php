<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend
//**Member */
Route::group([
    'namespace' => 'Frontend'
], function(){
    Route::get('/','HomeController@index');
    Route::get('/product-detail/{id}','HomeController@detail');
    Route::get('/shop/cart','CartController@showCart');
    Route::post('/shop/shopajax','CartController@addToCart');
    Route::get('/shop/delete/{id}','CartController@delete');
    Route::post('/shop/cartajax','CartController@updateQty');
    Route::get('/shop/checkout','HomeController@viewCheckOut');
    Route::post('/shop/checkout','HomeController@checkOut');
    Route::post('/','HomeController@search');
    Route::get('/shop/search-advance','HomeController@viewSearch');
    Route::post('/shop/result-search-advance','HomeController@searchAdvance');
    Route::post('/shop/priceajax','HomeController@priceSearch');

    //blog//
    Route::get('/blog/list','BlogController@index');
    Route::get('/blog/blog-single/{id}','BlogController@show');
    
    
    

    Route::group([
        'middleware' => 'memberNotLogin'
    ], function(){
        Route::get('/member-login','MemberController@showLogin');
        Route::post('/member-login','MemberController@login');
    
        Route::get('/member-register','MemberController@index');
        Route::post('/member-register','MemberController@register');
    });

    Route::group([
        'middleware' => 'member'
    ], function(){
        Route::get('/member-logout','MemberController@logout');
        Route::get('/member-profile','MemberController@show');
        Route::post('/member-profile','MemberController@update');
    
        //product
        Route::get('/myproduct/product','ProductController@index');
        Route::get('/myproduct/addproduct','ProductController@create');
        Route::post('/myproduct/addproduct','ProductController@store');
        Route::get('/myproduct/editproduct/{id}','ProductController@show');
        Route::post('/myproduct/editproduct/{id}','ProductController@update');
        Route::get('/myproduct/delete/{id}','ProductController@destroy');
        
        //Blog - rate & comment
        Route::post('/blog/blog-single/{id}','BlogController@comment');
        Route::post('/blog/ajax','BlogController@rate');
    });
    
});
//**Member */






//Admin
Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', 'LoginController@showLoginForm');
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function (){
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard','DashboardController@index');

    Route::get('/user','UserController@show');
    Route::post('/user','UserController@update');
    //**Country */
    Route::get('/country/country','CountryController@show');
    Route::get('/country/addcountry',function(){
        return view('admin.country.addcountry');
    });
    Route::post('/country/addcountry','CountryController@store');
    Route::get('/country/delete/{id}',"CountryController@destroy");

    //**Blog */
    Route::get('/blog/list','BlogController@index');
    Route::get('/blog/add',function(){
        return view('admin.blog.add');
    });
    Route::post('/blog/add','BlogController@store');
    Route::get('/blog/edit/{id}','BlogController@show');
    Route::post('/blog/edit/{id}','BlogController@update');
    Route::get('/blog/delete/{id}','BlogController@destroy');

    //**Category */
    Route::get('/category/list','CategoryController@show');
    Route::get('/category/addcategory',function(){
        return view('admin.category.addcategory');
    });
    Route::post('/category/addcategory','CategoryController@store');
    Route::get('/category/delete/{id}',"CategoryController@destroy");

    //**Brand */
    Route::get('/brand/list','BrandController@show');
    Route::get('/brand/addbrand',function(){
        return view('admin.brand.addbrand');
    });
    Route::post('/brand/addbrand','BrandController@store');
    Route::get('/brand/delete/{id}',"BrandController@destroy");
});














