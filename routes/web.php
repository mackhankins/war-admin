<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/auth/discord/redirect',
    'App\Http\Controllers\Auth\DiscordController@redirectToProvider'
)->name('discord-login');

Route::get(
    '/auth/discord/callback',
    'App\Http\Controllers\Auth\DiscordController@handleProviderCallback'
);

Route::prefix('character')->group(function () {
    Route::get(
        'create',
        'App\Http\Controllers\CharacterController@create',
    );
    Route::post(
        'save',
        'App\Http\Controllers\CharacterController@save',
    );
    Route::get(
        'edit/{user_id}',
        'App\Http\Controllers\CharacterController@edit',
    );

    Route::post(
        'update',
        'App\Http\Controllers\CharacterController@update',
    );

    Route::get(
        'getdata',
        'App\Http\Controllers\CharacterController@getdata',
    );

    Route::get(
        'getplayer/{id?}',
        'App\Http\Controllers\CharacterController@getplayer',
    );
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
