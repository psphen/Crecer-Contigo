<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

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
        Route::group(['prefix' => 'users'],function (){
            Route::get('/', [UserController::class, 'index'])->name('users.index');
        });
        //Cities
        Route::group(['prefix'=>'states'],function (){
            Route::get('/', [StateController::class, 'index'])->name('states.index');
        });
        //Cities
        Route::group(['prefix'=>'cities'],function (){
            Route::get('/', [CityController::class, 'index'])->name('cities.index');
        });
        //Services
        Route::group(['prefix'=>'services'],function (){
            Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        });
        //settings
        Route::group(['prefix'=>'settings'],function (){
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        });
        //Clients
        Route::group(['prefix' => 'client'], function (){
            Route::get('/', [ClientController::class, 'index'])->name('client.index');
        });
        //Contacts
        Route::group(['prefix' => 'contacts'], function (){
            Route::get('/', [ContactController::class, 'index'])->name('contact.index');
        });
        //Psychologists
        Route::group(['prefix' => 'psychologists'], function (){
            Route::get('/', [PsychologistController::class, 'index'])->name('psychologist.index');
        });
    });
    Route::get('/profile/{profile_slug}/{profile_id}','FrontendController@profile')->name('profile');
});
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/services', [FrontendController::class, 'services'])->name('frontend.service');
Route::get('/services/{id}', [FrontendController::class, 'servicesDetail'])->name('frontend.service.details');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about.index');

