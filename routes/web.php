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
use App\Livewire\IKU\PeriodManager;
use App\Livewire\Dashboard;

use App\Livewire\Auth\Login;
use App\Livewire\DaftarUser;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Guest;
use App\Livewire\Edokumen\Saya;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Livewire\ListTemplates;


use App\Livewire\UpdateProfile;
use App\Livewire\GenerateLetter;
use App\Livewire\UploadTemplate;
use App\Livewire\Eskripsi\Eskripsi;
use Illuminate\Support\Facades\Route;
use App\Livewire\Edokumen\pribadi\Skp;
use App\Livewire\Edokumen\UploadTertandai;
use App\Livewire\Edokumen\DokumenTertandai;
use App\Livewire\Edokumen\pribadi\Pendidikan;
use App\Livewire\Edokumen\pribadi\Pengajaran;
use App\Livewire\Edokumen\EditDokumenTertandai;
use Novay\WordTemplate\WordTemplate as WordTemplate;
use App\Livewire\Edokumen\Dashboard as EdokumenDashboard;
use App\Livewire\Edokumen\Dokumenpublik as Dokumenpublik;
use App\Livewire\Edokumen\Dosen\Persuratan\DetailSurat;
use App\Livewire\Edokumen\Persuratan\AjukanSurat as PersuratanAjukanSurat;
use App\Livewire\Edokumen\pribadi\Bimbingan\DetailBimbingan;
use App\Livewire\Edokumen\pribadi\Bimbingan\TambahBimbingan;
use App\Livewire\Edokumen\Tendik\Bimbingan\DataPembimbingan;
use App\Livewire\Edokumen\Tendik\Persuratan\SetTemplateHints;
use App\Livewire\Edokumen\Tendik\Dashboard as TendikDashboard;
use App\Livewire\Edokumen\Tendik\Persuratan\LetterDetailViewer;
use App\Livewire\Edokumen\Tendik\Bimbingan\EditDataPembimbingan;
use App\Livewire\Edokumen\Tendik\Bimbingan\TambahDataPembimbingan;
use App\Livewire\Edokumen\Tendik\Persuratan\Approval\ApproveLetters;
use App\Livewire\Edokumen\Tendik\Persuratan\Approved\ListSuratDitolak;
use App\Livewire\Edokumen\Tendik\Persuratan\Approval\ListPendingLetters;
use App\Livewire\Edokumen\Tendik\Persuratan\Approved\ListApprovedLetters;
use App\Livewire\Edokumen\Tendik\Persuratan\Verification\VerifyByTendik;
use App\Livewire\Edokumen\Tendik\Persuratan\Verification\ListVerificationTendik;
use App\Livewire\Edokumen\Tendik\Persuratan\Verification\ListVerificationDekan;
use App\Livewire\Edokumen\pribadi\Bimbingan\Bimbingan as BimbinganBimbingan;
use App\Livewire\Edokumen\Tendik\Persuratan\AjukanSurat;
use App\Livewire\Edokumen\Tendik\Persuratan\Approval\ListPendingLettersWithComponent;
use App\Livewire\Edokumen\Tendik\Persuratan\Approved\ListApprovedLettersWithComponent;
use App\Livewire\Edokumen\Tendik\Persuratan\CustomLetterManager;
use App\Livewire\Edokumen\Tendik\Persuratan\ListTemplates as PersuratanListTemplates;
use App\Livewire\Edokumen\Tendik\Persuratan\GenerateLetter as PersuratanGenerateLetter;
use App\Livewire\Edokumen\Tendik\Persuratan\UploadTemplate as PersuratanUploadTemplate;

Route::group(['middleware' => Guest::class], function () {

    //register
    // Route::get('/register', 'auth.register')->layout('layouts.app')->name('auth.register');

    //login
    


});

Route::get('/login', Login::class)->name('auth.login');

Route::group(['middleware' => Auth::class], function () {
    
    // Route::get('/counter', Counter::class)->name('counter');

    // Route::get('/tryout', Tryout::class)->name('tryout');
    // // E-SKRIPSI LOGIN
    // Route::get('/e-skripsi', Eskripsi::class)->name('eskripsi');
    
    Route::get('/admin/pengguna', DaftarUser::class)->name('admin.pengguna');

});

// Route::middleware(['auth'])->get('/profile', UpdateProfile::class)->name('profile');


Route::get('/apps', Apps::class)->name('apps');
Route::get('/', Apps::class)->name('home');
Route::get('/logout', Logout::class)->name('logout');





// Rute untuk melihat detail dan menyetujui/menolak surat
Route::get('/approval/letters/{letterId}', ApproveLetters::class)->name('approve.letter');

// Rute untuk melihat surat yang disetujui (jika Anda ingin QR code mengarah ke sini)
// Route public untuk QR Code access
Route::get('/surat/approved/{letterId}', LetterDetailViewer::class)->name('letters.approved.public');

Route::get('/surat/{letterId}/detail', LetterDetailViewer::class)->name('letters.show');

Route::middleware(['auth.dokumen','dosen'])->group(function () {
    Route::get('/dokumen/dashboard', EdokumenDashboard::class)->name('edokumen.dashboard');
    Route::get('/dokumen/pribadi', Saya::class)->name('dokumen.saya');
    Route::get('/dokumen/pribadi/pendidikan', Pendidikan::class)->name('pribadi.pendidikan');
    Route::get('/dokumen/publik', Dokumenpublik::class)->name('dokumen.publik');
    Route::get('/dokumen/tandai', DokumenTertandai::class)->name('dokumen.tandai');
    Route::get('/dokumen/tandai/upload', UploadTertandai::class)->name('dokumen.tandai.upload');
    Route::get('/dokumen/tandai/edit/{hashid}', EditDokumenTertandai::class)->name('dokumen.tandai.edit');
    Route::get('/profile', UpdateProfile::class)->name('profile');
    Route::get('/dokumen/pribadi/skp', Skp::class)->name('skp');
    Route::get('/dokumen/pendidikan/bimbingan', BimbinganBimbingan::class)->name('bimbingan');
    Route::get('/dokumen/pendidikan/bimbingan/detail', DetailBimbingan::class)->name('bimbingan.detail');
    Route::get('/dokumen/pendidikan/bimbingan/tambah', TambahBimbingan::class)->name('bimbingan.tambah');
    Route::get('/dokumen/pendidikan/pengajaran', Pengajaran::class)->name('pengajaran');
    Route::get('/dokumen/dosen/persuratan/ajukan', PersuratanAjukanSurat::class)->name('dosen.persuratan.ajukan-surat');
    Route::get('/dokumen/dosen/persuratan/ajukan/{templateId}', PersuratanAjukanSurat::class)->name('dosen.persuratan.ajukan-surat.template');
    Route::get('/dokumen/dosen/persuratan/detail/{letterId}', DetailSurat::class)->name('dosen.persuratan.detail-surat');
    Route::get('/dokumen/dosen/persuratan/list-surat', ListPendingLetters::class)->name('dosen.persuratan.list-surat');
});



Route::middleware(['auth.dokumen','tendik'])->group(function () {
    Route::get('/dokumen/tendik/dashboard', TendikDashboard::class)->name('tendik.dashboard');
    Route::get('/dokumen/tendik/data-pembimbingan', DataPembimbingan::class)->name('tendik.pembimbingan');
    Route::get('/dokumen/tendik/data-pembimbingan/tambah', TambahDataPembimbingan::class)->name('tendik.tambah.pembimbingan');
    Route::get('/dokumen/tendik/data-pembimbingan/edit/{hashid}', EditDataPembimbingan::class)->name('tendik.edit.pembimbingan');
    Route::get('/dokumen/persuratan/templates/upload-template', PersuratanUploadTemplate::class)->name('admin.upload.template');
    Route::get('/dokumen/persuratan/templates', PersuratanListTemplates::class)->name('admin.templates');
    Route::get('/dokumen/persuratan/templates/generate-letter/{templateId}', PersuratanGenerateLetter::class)->name('generate.letter');
    Route::get('/dokumen/persuratan/disetujui/', ListApprovedLetters::class)->name('list.approved.letters');
    Route::get('/dokumen/persuratan/ditolak/', ListSuratDitolak::class)->name('list.surat.tolak');
    Route::get('/dokumen/persuratan/templates/{templateId}/set-hints', SetTemplateHints::class)->name('templates.set-hints');
    
    // Verifikasi Tendik
    Route::get('/dokumen/persuratan/verifikasi-tendik', ListVerificationTendik::class)->name('list.verification.tendik');
    Route::get('/dokumen/persuratan/verifikasi-tendik/detail/{letterId}', VerifyByTendik::class)->name('verify.by.tendik');
    
    // Verifikasi Dekan (untuk melihat surat yang menunggu persetujuan Dekan)
    Route::get('/dokumen/persuratan/verifikasi-dekan', ListVerificationDekan::class)->name('list.verification.dekan');
    Route::get('/dokumen/persuratan/verifikasi-dekan/detail/{letterId}', ApproveLetters::class)->name('dekan.approve.letter');
    
    Route::get('/dokumen/persuratan/surat-custom', CustomLetterManager::class)->name('tendik.custom.letters');
    
    // Legacy routes for backward compatibility
    Route::get('/dokumen/persuratan/butuh-persetujuan', ListPendingLetters::class)->name('list.pending.letters');
    Route::get('/dokumen/persuratan/butuh-persetujuan/detail/{letterId}', ApproveLetters::class)->name('legacy.approve.letter');
});

Route::middleware('auth.iku')->group(function(){
    Route::get('/iku/dashboard', Dashboard::class)->name('iku.dashboard');
    Route::get('/iku/periods', PeriodManager::class)->name('iku.periods');
    Route::get('/iku/iku-1', Iku1::class)->name('iku1');
    Route::get('/iku/iku-2', Iku2::class)->name('iku2');
    Route::get('/iku/iku-3', Iku3::class)->name('iku3');
    Route::get('/iku/iku-4', Iku4::class)->name('iku4');
    Route::get('/iku/iku-5', Iku5::class)->name('iku5');
    Route::get('/iku/iku-6', Iku6::class)->name('iku6');
    Route::get('/iku/iku-7', Iku7::class)->name('iku7');
    Route::get('/iku/iku-8', Iku8::class)->name('iku8');
});

// Telegram Bot Testing Routes (only in development)
if (config('app.debug')) {
    Route::prefix('telegram')->group(function () {
        Route::get('/test', [\App\Http\Controllers\TelegramTestController::class, 'index'])->name('telegram.test.index');
        Route::get('/test-connection', [\App\Http\Controllers\TelegramTestController::class, 'testConnection'])->name('telegram.test.connection');
        Route::post('/daily-summary', [\App\Http\Controllers\TelegramTestController::class, 'sendDailySummary'])->name('telegram.daily.summary');
        Route::post('/test-letter/{letterId}', [\App\Http\Controllers\TelegramTestController::class, 'testLetterNotification'])->name('telegram.test.letter');
    });
}