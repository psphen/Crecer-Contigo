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
        //Cities
        Route::group(['prefix'=>'states'],function (){
            Route::get('/', 'StateController@index')->name('states.index');
        });
        //Cities
        Route::group(['prefix'=>'cities'],function (){
            Route::get('/', 'CityController@index')->name('cities.index');
        });
        //Services
        Route::group(['prefix'=>'services'],function (){
            Route::get('/', 'ServiceController@index')->name('services.index');
        });
        //settings
        Route::group(['prefix'=>'settings'],function (){
            Route::get('/', 'SettingController@index')->name('settings.index');
        });
        //Clients
        Route::group(['prefix' => 'client'], function (){
            Route::get('/', 'ClientController@index')->name('client.index');
        });
        //Contacts
        Route::group(['prefix' => 'contacts'], function (){
            Route::get('/', 'ContactController@index')->name('contact.index');
        });
    });
    Route::get('/profile/{profile_slug}/{profile_id}','FrontendController@profile')->name('profile');
});
Route::get('/','FrontendController@index')->name('frontend.index');
Route::get('/about-us','FrontendController@about')->name('about.index');

