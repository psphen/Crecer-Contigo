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
    });
    Route::get('/profile/{profile_slug}/{profile_id}','FrontendController@profile')->name('profile');
});
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

