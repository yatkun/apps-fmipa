<?php

use App\Livewire\Apps;

use App\Livewire\Logout;
use App\Livewire\Tryout;
use App\Livewire\Counter;
use App\Livewire\Landing;
use App\Models\Bimbingan;
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
use App\Livewire\DaftarUser;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use App\Livewire\Edokumen\Saya;
use App\Livewire\UpdateProfile;


use App\Livewire\Eskripsi\Eskripsi;
use Illuminate\Support\Facades\Route;
use App\Livewire\Edokumen\pribadi\Skp;
use App\Livewire\Edokumen\UploadTertandai;
use App\Livewire\Edokumen\DokumenTertandai;
use App\Livewire\Edokumen\pribadi\Pendidikan;
use App\Livewire\Edokumen\EditDokumenTertandai;
use App\Livewire\Edokumen\Dashboard as EdokumenDashboard;
use App\Livewire\Edokumen\Dokumenpublik as Dokumenpublik;
use App\Livewire\Edokumen\pribadi\Bimbingan as PribadiBimbingan;
use App\Livewire\Edokumen\pribadi\Pengajaran;

Route::group(['middleware' => Guest::class], function () {

    //register
    // Route::get('/register', 'auth.register')->layout('layouts.app')->name('auth.register');

    //login
    Route::get('/login', Login::class)->name('auth.login');


});

Route::group(['middleware' => Auth::class], function () {
    
    // Route::get('/counter', Counter::class)->name('counter');

    // Route::get('/tryout', Tryout::class)->name('tryout');
    // // E-SKRIPSI LOGIN
    // Route::get('/e-skripsi', Eskripsi::class)->name('eskripsi');
    
    Route::get('/admin/pengguna', DaftarUser::class)->name('admin.pengguna');

});

// Route::middleware(['auth'])->get('/profile', UpdateProfile::class)->name('profile');


Route::get('/apps', Apps::class)->name('apps');
Route::get('/', Apps::class)->name('apps');
Route::get('/logout', Logout::class)->name('logout');

Route::middleware('auth.dokumen')->group(function () {
    Route::get('/dokumen/dashboard', EdokumenDashboard::class)->name('edokumen.dashboard');
    Route::get('/dokumen/pribadi', Saya::class)->name('dokumen.saya');
    Route::get('/dokumen/pribadi/pendidikan', Pendidikan::class)->name('pribadi.pendidikan');
    Route::get('/dokumen/publik', Dokumenpublik::class)->name('dokumen.publik');
    Route::get('/dokumen/tandai', DokumenTertandai::class)->name('dokumen.tandai');
    Route::get('/dokumen/tandai/upload', UploadTertandai::class)->name('dokumen.tandai.upload');
    Route::get('/dokumen/tandai/edit/{hashid}', EditDokumenTertandai::class)->name('dokumen.tandai.edit');
    Route::get('/profile', UpdateProfile::class)->name('profile');
    Route::get('/dokumen/pribadi/skp', Skp::class)->name('skp');
    Route::get('/dokumen/pendidikan/bimbingan', PribadiBimbingan::class)->name('bimbingan');
    Route::get('/dokumen/pendidikan/pengajaran', Pengajaran::class)->name('pengajaran');
});

Route::middleware('auth.iku')->group(function(){
    Route::get('/iku/dashboard', Dashboard::class)->name('iku.dashboard');
    Route::get('/iku/iku-1', Iku1::class)->name('iku1');
    Route::get('/iku/iku-2', Iku2::class)->name('iku2');
    Route::get('/iku/iku-3', Iku3::class)->name('iku3');
    Route::get('/iku/iku-4', Iku4::class)->name('iku4');
    Route::get('/iku/iku-5', Iku5::class)->name('iku5');
    Route::get('/iku/iku-6', Iku6::class)->name('iku6');
    Route::get('/iku/iku-7', Iku7::class)->name('iku7');
    Route::get('/iku/iku-8', Iku8::class)->name('iku8');
});