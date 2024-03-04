<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\kehadiranController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\tingkatController;
use App\Http\Controllers\generatorqrcodeController;
use App\Http\Controllers\scanqrController;
use App\Http\Controllers\OtherController;
// use App\Http\Controllers\QRController;
// use App\Http\Controllers\testController;
// use PHPUnit\Event\Code\Test;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|--------------------------------------------------------------------------
*/

// Version Area
Route::get('version', [OtherController::class, 'version'])->name('version');

// get data area
Route::get('/hitung-absen', [SiswaController::class, 'tampilkanDataAbsensi'])->name('data_absen_pertanggal');

// Report Area Setting
Route::get('laporan/{year}/{month}/{kelas}', [SiswaController::class, 'laporan_data'])->name('laporan_data');
Route::get('laporan', [SiswaController::class, 'laporan'])->name('laporan');

// Other Area Setting
Route::get('generate-qr', [generatorqrcodeController::class, 'generate_qr'])->name('qr_siswa');
Route::get('generate', [generatorqrcodeController::class, 'generate'])->name('generate');

// Scan Masuk Dan Keluar Kehadiran
Route::get('absen', [scanqrController::class, 'scan'])->name('scan');
Route::get('absen/masuk', [scanqrController::class, 'scan_masuk'])->name('scan_masuk');
Route::get('absen/keluar', [scanqrController::class, 'scan_keluar'])->name('scan_keluar');
Route::post('cek-qr/masuk', [scanqrController::class, 'masuk_cek'])->name('masuk_cek');
Route::post('cek-qr/pulang', [scanqrController::class, 'pulang_cek'])->name('pulang_cek');

// kehadiran Area Setting
// Route::get('data-kehadiran/filter', [kehadiranController::class, 'kehadiran_filter'])->name('kehadiran_filter');
Route::get('data-kehadiran', [kehadiranController::class, 'data_kehadiran'])->name('data_kehadiran');
Route::get('filter-absensi', [kehadiranController::class, 'filter_absensi'])->name('filter_absensi');
Route::get('kehadiran/{id}', [kehadiranController::class, 'buat_kehadiran'])->name('buat_kehadiran');
Route::put('update-kehadiran', [kehadiranController::class, 'kirim_kehadiran'])->name('kirim_kehadiran');

// Tingkat Area Setting
Route::get('edit-tingkat/{tingkat}', [tingkatController::class, 'edit_tingkat'])->name('tingkat_edit');
Route::get('tambah-tingkat', [tingkatController::class, 'tambah_tingkat'])->name('tambah_tingkat');
Route::get('data-tingkat', [tingkatController::class, 'data_tingkat'])->name('data_tingkat');
Route::put('edit-tingkat/action/{tingkat}', [tingkatController::class, 'update_tingkat'])->name('tingkat_update');
Route::delete('data-tingkat/delete/{tingkat}', [tingkatController::class, 'tingkat_delete'])->name('tingkat_delete');
Route::post('tambah-tingkat/tingkat-baru', [tingkatController::class, 'buat_tingkat'])->name('buat_tingkat');

// Kelas Area Setting
Route::get('data-kelas', [kelasController::class, 'data_kelas'])->name('data_kelas');
Route::get('tambah-kelas', [kelasController::class, 'tambah_kelas'])->name('tambah_kelas');
Route::get('edit-kelas/{kelas}', [kelasController::class, 'edit_kelas'])->name('kelas_edit');
Route::put('edit-kelas/action/{kelas}', [kelasController::class, 'update_kelas'])->name('kelas_update');
Route::delete('data-kelas/delete/{kelas}', [kelasController::class, 'kelas_delete'])->name('kelas_delete');
Route::post('tambah-kelas/kelas-baru', [kelasController::class, 'buat_kelas'])->name('buat_kelas');

// Siswa Area Settings
Route::get('edit-siswa/{siswa}', [MuridController::class, 'edit_siswa'])->name('siswa_edit');
Route::put('edit-siswa/action/{siswa}', [MuridController::class, 'update'])->name('siswa_update');
Route::get('data-siswa', [MuridController::class, 'data_siswa'])->name('data_siswa');
Route::delete('data-siswa/delete/{siswa}', [MuridController::class, 'siswa_delete'])->name('siswa_delete');
Route::get('tambah-siswa', [MuridController::class, 'tambah_siswa'])->name('tambah_siswa');
Route::post('tambah-siswa/siswa-baru', [MuridController::class, 'buat_siswa'])->name('buat_siswa');

// User Area Settings
Route::get('tambah-pengelola', [UserController::class, 'tambah_pengelola'])->name('user_new');
Route::post('tambah-pengelola/new-user', [UserController::class, 'create_user'])->name('create_user');
Route::get('setting',  [UserController::class, 'user_setting'])->name('user_detail');
Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('user_delete');
Route::get('/setting/{user}', [UserController::class, 'edit'])->name('user_edit');
Route::put('/setting/action/{user}', [UserController::class, 'update'])->name('user_update');

// Login Area or Account Area Auth
Route::get('/', [AuthController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/new-user', [AuthController::class, 'actionregister'])->name('actionregister');
Route::get('actionlogout', [AuthController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');