<?php

use App\Models\GenerateSurat;
use App\Http\Middleware\Kepala;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\SuratKeluarController;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Login
Route::get('/', function () {
    return redirect()->route('home');//direct ke route home
});
Route::get('/home', function(){
    return view('website.home');
})->name('home');

//dashboard auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->roletype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif($user->roletype === 'kepala'){
            return redirect()->route('kepala.dashboard');
        }elseif($user->roletype === 'pegawai'){
            return redirect()->route('pegawai.dashboard');
        } else {
            return abort(403, 'Unauthorized');
        }
    })->name('dashboard');
});

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::get('/admin/people_management', [UserController::class, 'index'])->name('admin.manajemen_anggota.index');
Route::get('/admin/job_management', [JabatanController::class, 'index'])->name('admin.manajemen_jabatan.index');
Route::get('/admin/inbox', [SuratMasukController::class, 'index'])->name('admin.surat_masuk.index');
Route::get('/admin/outbox', [SuratKeluarController::class, 'index'])->name('admin.surat_keluar.index');
Route::get('/admin/archive', [ArsipController::class, 'index'])->name('SuratMasuk.arsip.index');
Route::get('/admin/classify', [KlasifikasiController::class, 'index'])->name('SuratKeluar.klasifikasi.index');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.user_settings.index'); 

//Kepala
Route::middleware(['auth', 'kepala'])->group(callback: function () {
    Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');  
});
Route::get('/kepala/people_management', [UserController::class, 'index'])->name('kepala.manajemen_anggota.index');
Route::get('/kepala/job_management', [JabatanController::class, 'index'])->name('kepala.manajemen_jabatan.index');
Route::get('/kepala/inbox', [SuratMasukController::class, 'index'])->name('kepala.surat_masuk.index');
Route::get('/kepala/outbox', [SuratKeluarController::class, 'index'])->name('kepala.surat_keluar.index');
Route::get('/kepala/archive', [ArsipController::class, 'index'])->name('SuratMasuk.arsip.index');
Route::get('/kepala/classify', [KlasifikasiController::class, 'index'])->name('SuratKeluar.klasifikasi.index');
Route::get('/kepala/settings', [SettingController::class, 'index'])->name('kepala.user_settings.index');   

//Pegawai
Route::middleware(['auth', 'pegawai'])->group(callback: function () {
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
});
Route::get('/pegawai/inbox', [SuratMasukController::class, 'index'])->name('pegawai.surat_masuk.index');
Route::get('/pegawai/outbox', [SuratKeluarController::class, 'index'])->name('pegawai.surat_keluar.index');
Route::get('/pegawai/archive', [ArsipController::class, 'index'])->name('SuratMasuk.arsip.index');
Route::get('/pegawai/classify', [KlasifikasiController::class, 'index'])->name('SuratKeluar.klasifikasi.index');
Route::get('/pegawai/settings', [SettingController::class, 'index'])->name('pegawai.user_settings.index');  

// Manajemen Pengguna
Route::get('/people_management/create', [UserController::class, 'create'])->name('website.manajemen_anggota.create');
Route::post('/people_management/input', [UserController::class, 'input'])->name('website.manajemen_anggota.input');
Route::PUT('/people_management/{id}', [UserController::class, 'update'])->name('website.manajemen_anggota.update');
Route::get('/people_management/{id}/edit', [UserController::class, 'edit'])->name('website.manajemen_anggota.edit');
Route::delete('/people_management/{id}/hapus', [UserController::class, 'hapus'])->name('website.manajemen_anggota.hapus');

// Manajemen Jabatan
Route::get('/job_management/create', [JabatanController::class, 'create'])->name('website.manajemen_jabatan.create');
Route::post('/job_management/input', [JabatanController::class, 'input'])->name('website.manajemen_jabatan.input');
Route::delete('/job_management/{id}/hapus', [JabatanController::class, 'hapus'])->name('website.manajemen_jabatan.hapus');

//Surat Masuk
Route::get('/inbox/create', [SuratMasukController::class, 'create'])->name('website.surat_masuk.create');
Route::post('/inbox/input', [SuratMasukController::class, 'input'])->name('website.surat_masuk.input');
Route::delete('/inbox/{id}/hapus', [SuratMasukController::class, 'hapus'])->name('website.surat_masuk.hapus');
Route::get('/inbox/{id}/lihat', [SuratMasukController::class, 'lihat'])->name('website.surat_masuk.lihat');
Route::get('/inbox/{id}/disposisi', [SuratMasukController::class, 'disposisi'])->name('website.surat_masuk.disposisi');
Route::post('/inbox/{id}/simpan', [SuratMasukController::class, 'simpan'])->name('website.surat_masuk.simpan');
Route::get('/inbox/{id}/tindaklanjut', [SuratMasukController::class, 'tindaklanjut'])->name('website.surat_masuk.tindaklanjut');
Route::post('/inbox/{id}/finish', [SuratMasukController::class, 'finish'])->name('website.surat_masuk.finish');

//Surat Keluar
Route::get('/outbox/generate', function () {
    return view('SuratKeluar.generate');
})->name('website.surat_keluar.form');

Route::post('/outbox/generate', [SuratKeluarController::class, 'generateSurat'])->name('website.surat_keluar.generate');
Route::get('/get-last-number', function() {
    $tahunSekarang = now()->year;
    $lastSurat = GenerateSurat::whereYear('created_at', $tahunSekarang)->orderBy('id', 'desc')->first();
    
    return response()->json([
        'last_number' => $lastSurat ? intval($lastSurat->nomor2) : 0
    ]);
})->name('website.surat_keluar.getLastNumber');
Route::delete('/outbox/{id}', [SuratKeluarController::class, 'deleteSurat'])->name('surat_keluar.delete');
Route::get('/outbox/download/{id}', [SuratKeluarController::class, 'downloadSurat'])->name('surat_keluar.download');

//Setting
Route::get('user/{id}/edit', [SettingController::class, 'edit'])->name('Setting.user_settings.edit');
Route::put('user/{id}', [SettingController::class, 'update'])->name('Setting.user_settings.update');

// logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';

