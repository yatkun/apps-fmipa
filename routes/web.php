<?php

use App\Livewire\Logout;

use App\Livewire\Counter;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use App\Livewire\Apps;
use App\Livewire\Iku1;
use App\Livewire\Iku2;
use App\Livewire\Landing;
use App\Livewire\Tryout;
use Illuminate\Support\Facades\Route;






Route::group(['middleware' => Guest::class], function () {

    //register
    // Route::get('/register', 'auth.register')->layout('layouts.app')->name('auth.register');

    //login



});

Route::group(['middleware' => Auth::class], function () {
    Route::get('/iku/dashboard', Dashboard::class)->name('iku.dashboard');
    Route::get('/counter', Counter::class)->name('counter');

    Route::get('/tryout', Tryout::class)->name('tryout');


    Route::get('/logout', Logout::class)->name('logout');
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/iku/iku-1', Iku1::class)->name('iku1');
    Route::get('/iku/iku-2', Iku2::class)->name('iku2');
    Route::get('/apps', Apps::class)->name('apps');

    Route::get('/', Landing::class)->name('landing');
});


Route::get('/login', Login::class)->name('auth.login');
