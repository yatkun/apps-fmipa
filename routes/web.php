<?php

use App\Livewire\Apps;

use App\Livewire\Logout;
use App\Livewire\Tryout;
use App\Livewire\Counter;
use App\Livewire\Landing;
use App\Livewire\IKU\Iku1;
use App\Livewire\IKU\Iku2;

use App\Livewire\IKU\Iku3;
use App\Livewire\IKU\Iku4;
use App\Livewire\IKU\Iku5;
use App\Livewire\IKU\Iku6;
use App\Livewire\IKU\Iku7;
use App\Livewire\IKU\Iku8;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;

use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use App\Livewire\Eskripsi\Eskripsi;
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
    

    Route::get('/iku/iku-1', Iku1::class)->name('iku1');
    Route::get('/iku/iku-2', Iku2::class)->name('iku2');
    Route::get('/iku/iku-3', Iku3::class)->name('iku3');
    Route::get('/iku/iku-4', Iku4::class)->name('iku4');
    Route::get('/iku/iku-5', Iku5::class)->name('iku5');
    Route::get('/iku/iku-6', Iku6::class)->name('iku6');
    Route::get('/iku/iku-7', Iku7::class)->name('iku7');
    Route::get('/iku/iku-8', Iku8::class)->name('iku8');
    
    Route::get('/apps', Apps::class)->name('apps');
    Route::get('/', Apps::class)->name('apps');



    // E-SKRIPSI LOGIN
    Route::get('/e-skripsi', Eskripsi::class)->name('eskripsi');

});


Route::get('/login', Login::class)->name('auth.login');
