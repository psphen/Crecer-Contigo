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
Auth::routes();
//Languages
Route::get('/set_language/{lang}','Controller@set_language')->name('set_language');
//Auth
Route::group(['middleware'=>'auth'],function (){
    //Dashboard
    Route::group(['prefix'=>'dashboard'],function (){
        //Dashboard
        Route::get('/', 'HomeController@index')->name('dashboard');
        //Users
        Route::group(['prefix'=>'users'],function (){
            Route::get('/', 'UserController@index')->name('users.index');
        });
        //Vendors
        Route::group(['prefix'=>'vendors'],function (){
            Route::get('/', 'VendorController@index')->name('vendors.index');
        });
        //customers
        Route::group(['prefix'=>'customers'],function (){
            Route::get('/', 'CustomerController@index')->name('customers.index');
        });
        //Cities
        Route::group(['prefix'=>'states'],function (){
            Route::get('/', 'StateController@index')->name('states.index');
        });
        //Cities
        Route::group(['prefix'=>'cities'],function (){
            Route::get('/', 'CityController@index')->name('cities.index');
        });
        //Categories
        Route::group(['prefix'=>'categories'],function (){
            Route::get('/', 'CategoryController@index')->name('categories.index');
        });
        //Places
        Route::group(['prefix'=>'subcategories'],function (){
            Route::get('/', 'SubcategoryController@index')->name('subcategories.index');
        });
        //Services
        Route::group(['prefix'=>'services'],function (){
            Route::get('/', 'ServiceController@index')->name('services.index');
        });
        //Places
        Route::group(['prefix'=>'places'],function (){
            Route::get('/', 'PlaceController@index')->name('places.index');
        });
        //Places
        Route::group(['prefix'=>'posts'],function (){
            Route::get('/', 'PostController@index')->name('posts.index');
        });
        //Blogs
        Route::group(['prefix'=>'blogs'],function (){
            Route::get('/', 'BlogController@index')->name('blogs.index');
        });
        //testimonials
        Route::group(['prefix'=>'testimonials'],function (){
            Route::get('/', 'TestimonialController@index')->name('testimonials.index');
        });
        //reviews
        Route::group(['prefix'=>'reviews'],function (){
            Route::get('/', 'ReviewController@index')->name('reviews.index');
        });
        //settings
        Route::group(['prefix'=>'settings'],function (){
            Route::get('/', 'SettingController@index')->name('settings.index');
        });
    });
    Route::get('/profile/{profile_slug}/{profile_id}','FrontendController@profile')->name('profile');
});
Route::get('/','FrontendController@index')->name('frontend.index');
Route::get('/about-us','FrontendController@about')->name('about.index');

