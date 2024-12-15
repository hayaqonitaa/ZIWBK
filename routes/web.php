<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\user_page\HasilSurvey;
use App\Http\Controllers\user_page\StandarPelayanan;
use App\Http\Controllers\user_page\LayananPengaduan;
use App\Http\Controllers\user_page\LayananPengaduanController;
use App\Http\Controllers\admin_page\AdminController;
use App\Http\Controllers\admin_page\MahasiswaController;
use App\Http\Controllers\admin_page\JurusanController;
use App\Http\Controllers\admin_page\ProdiController;
use App\Http\Controllers\admin_page\KuesionerController;
use App\Http\Controllers\user_page\AgenPerubahanController;
use App\Http\Controllers\user_page\TimKerjaController;
use App\Http\Controllers\user_page\TimController;
use App\Http\Controllers\admin_page\PembagianController;
use App\Http\Controllers\admin_page\PemetaanController;
use App\Http\Controllers\admin_page\UserController;
use App\Http\Controllers\admin_page\MahasiswaImportController;
use App\Http\Controllers\admin_page\HasilSurveyController;
use App\Http\Controllers\admin_page\GrafikController;
use App\Http\Controllers\authentications\LoginCover;



use App\Http\Controllers\konten\ContentTimKerjaController;
use App\Http\Controllers\konten\ContentAgenPerubahanController;
use App\Http\Controllers\konten\ContentLayananPengaduanController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\user_page\StandarPelayananController;
use App\Http\Controllers\user_page\PiagamController;
use App\Http\Controllers\konten\ContentStandarPelayananController;
use App\Http\Controllers\konten\ContentPiagamController;
use App\Http\Controllers\konten\ContentBeritaController;
use App\Http\Controllers\pages\MiscError;


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/standar-pelayanan', [StandarPelayananController::class, 'index'])->name('standar-pelayanan');
Route::get('/piagam', [PiagamController::class, 'index'])->name('piagam');
Route::get('/layanan-pengaduan', [LayananPengaduanController::class, 'index']);
Route::get('/tim', [TimController::class, 'index']);
Route::get('/auth/login-cover', [LoginCover::class, 'index'])->name('auth-login-cover');
Route::post('/auth/login', [LoginCover::class, 'authenticate'])->name('auth-login');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');


Route::get('/hasil-survey', [HasilSurveyController::class, 'index'])->name('hasil_survey.index')->middleware('auth');
Route::post('/hasil-survey/import', [HasilSurveyController::class, 'import'])->name('hasil_survey.import')->middleware('auth');
Route::get('/api/hasil-survey', [HasilSurveyController::class, 'getHasilSurvey'])->middleware('auth');
Route::get('/api/mahasiswa', [HasilSurveyController::class, 'getMahasiswa'])->middleware('auth');
Route::get('/api/kuesioner', [HasilSurveyController::class, 'getKuesioner'])->middleware('auth');

Route::post('/auth/logout', [LoginCover::class, 'logout'])->name('auth-logout')->middleware('auth');
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->middleware('auth');
Route::get('/mahasiswa/data', [MahasiswaController::class, 'getMahasiswa'])->middleware('auth'); // untuk mengambil data mahasiswa
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->middleware('auth');
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update')->middleware('auth');
Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy')->middleware('auth');
Route::post('/mahasiswa/uploadExcel', [MahasiswaController::class, 'uploadExcel'])->middleware('auth');
Route::get('mahasiswa/download-template', [mahasiswaController::class, 'downloadTemplate'])->name('mahasiswa.template')->middleware('auth');

Route::get('/jurusan', [JurusanController::class, 'index'])->name('admin-page.jurusan.jurusan')->middleware('auth');
Route::get('/jurusan/data', [JurusanController::class, 'getJurusan'])->middleware('auth'); 
Route::post('/jurusan/store', [JurusanController::class, 'store'])->middleware('auth');
Route::put('/jurusan/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update')->middleware('auth');
Route::delete('/jurusan/delete/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy')->middleware('auth');

Route::get('/prodi/jurusan/data', [ProdiController::class, 'getJurusan'])->middleware('auth');
Route::get('/prodi', [ProdiController::class, 'index'])->name('admin-page.prodi.prodi')->middleware('auth');
Route::get('/prodi/data', [ProdiController::class, 'getProdi'])->middleware('auth'); 
Route::post('/prodi/store', [ProdiController::class, 'store'])->middleware('auth');
Route::put('/prodi/update/{id}', [ProdiController::class, 'update'])->name('prodi.update')->middleware('auth');
Route::delete('/prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy')->middleware('auth');

Route::get('/kuesioner', [KuesionerController::class, 'index'])->name('admin-page.kuesioner.kuesoner')->middleware('auth');
Route::get('/kuesioner/data', [KuesionerController::class, 'getKuesioner'])->name('kuesioner.data')->middleware('auth'); 
Route::post('/kuesioner/store', [KuesionerController::class, 'store'])->middleware('auth');
Route::put('/kuesioner/update/{id}', [KuesionerController::class, 'update'])->name('kuesioner.update')->middleware('auth');
Route::delete('/kuesioner/delete/{id}', [KuesionerController::class, 'destroy'])->name('kuesioner.destroy')->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->name('admin.user.index')->middleware('auth');
Route::get('/user/data', [UserController::class, 'getUsers'])->name('admin.user.get')->middleware('auth');
Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store')->middleware('auth');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update')->middleware('auth');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete')->middleware('auth');

Route::get('/pembagian', [PembagianController::class, 'index'])->name('admin-page.pembagian.pembagian')->middleware('auth');
Route::delete('/pembagian/delete/{id}', [PembagianController::class, 'destroy'])->name('pembagian.destroy')->middleware('auth');
Route::post('/pembagian/share', [PembagianController::class, 'share'])->name('pembagian.share')->middleware('auth');
Route::get('/pembagian/data', [PembagianController::class, 'getPembagian'])->name('pembagian.data')->middleware('auth'); 
Route::post('/pembagian/kirim', [PembagianController::class, 'kirimEmail'])->middleware('auth');
Route::get('/pemetaan', [PemetaanController::class, 'index'])->name('admin-page.pembagian.pemetaan')->middleware('auth');

Route::get('/hasil_survey', [HasilSurveyController::class, 'index'])->name('admin-page.hasil_survey.hasil_survey')->middleware('auth');
Route::get('/hasil_survey/data', [HasilSurveyController::class, 'getHasilSurvey'])->middleware('auth'); 
Route::delete('/hasil_survey/delete/{id}', [HasilSurveyController::class, 'destroy'])->name('hasil_survey.destroy')->middleware('auth');
Route::post('/import-hasil-survey', [HasilSurveyController::class, 'import'])->name('import-hasil-survey');

Route::get('/grafik', [GrafikController::class, 'index'])->middleware('auth');
Route::get('/grafik/data/{tahun}', [GrafikController::class, 'getSurveyData'])->middleware('auth');

Route::get('/content-categories', [ContentCategoriesController::class, 'index'])->name('admin-page.content_categories.index')->middleware('auth');
Route::get('/content-categories/data', [ContentCategoriesController::class, 'getContentCategories'])->name('content-categories.data')->middleware('auth');
Route::post('/content_categories/store', [ContentCategoriesController::class, 'store'])->name('content_categories.store')->middleware('auth');
Route::put('/content_categories/update/{id}', [ContentCategoriesController::class, 'update'])->name('content_categories.update')->middleware('auth');
Route::delete('/content-categories/delete/{id}', [ContentCategoriesController::class, 'destroy'])->name('content_categories.destroy')->middleware('auth');

Route::get('/content/agen_perubahan', [ContentAgenPerubahanController::class, 'index'])->name('konten.agen_perubahan.index')->middleware('auth');
Route::get('/content/agen_perubahan/data', [ContentAgenPerubahanController::class, 'getAgenPerubahan'])->name('konten.agen_perubahan.data')->middleware('auth');
Route::post('/content/agen_perubahan/store', [ContentAgenPerubahanController::class, 'store'])->middleware('auth');
Route::post('/content/agen_perubahan/update/{id}', [ContentAgenPerubahanController::class, 'update'])->name('konten.agen_perubahan.update')->middleware('auth');
Route::delete('/content/agen_perubahan/delete/{id}', [ContentAgenPerubahanController::class, 'destroy'])->name('konten.agen_perubahan.delete')->middleware('auth');


Route::get('/content/tim_kerja', [ContentTimKerjaController::class, 'index'])->name('konten.tim_kerja.index')->middleware('auth');
Route::get('/content/tim_kerja/data', [ContentTimKerjaController::class, 'getTimKerja'])->name('konten.tim_kerja.data')->middleware('auth');
Route::post('/content/tim_kerja/store', [ContentTimKerjaController::class, 'store'])->middleware('auth');
Route::post('/content/tim_kerja/update/{id}', [ContentTimKerjaController::class, 'update'])->name('konten.tim_kerja.update')->middleware('auth');
Route::delete('/content/tim_kerja/delete/{id}', [ContentTimKerjaController::class, 'destroy'])->name('konten.tim_kerja.delete')->middleware('auth');


Route::get('/content/standar_pelayanan', [ContentStandarPelayananController::class, 'index'])->name('konten.standar_pelayanan.index')->middleware('auth');
Route::get('/content/standar_pelayanan/data', [ContentStandarPelayananController::class, 'getStandarPelayanan'])->name('konten.standar_pelayanan.data')->middleware('auth');
Route::post('/content/standar_pelayanan/store', [ContentStandarPelayananController::class, 'store'])->middleware('auth');
Route::post('/content/standar_pelayanan/update/{id}', [ContentStandarPelayananController::class, 'update'])->name('konten.standar_pelayanan.update')->middleware('auth');
Route::delete('/content/standar_pelayanan/delete/{id}', [ContentStandarPelayananController::class, 'destroy'])->name('konten.standar_pelayanan.delete')->middleware('auth');


Route::get('/content/layanan_pengaduan', [ContentLayananPengaduanController::class, 'index'])->name('konten.layanan_pengaduan.index')->middleware('auth');
Route::get('/content/layanan_pengaduan/data', [ContentLayananPengaduanController::class, 'getLayananPengaduan'])->name('konten.layanan_pengaduan.data')->middleware('auth');
Route::post('/content/layanan_pengaduan/store', [ContentLayananPengaduanController::class, 'store'])->middleware('auth');
Route::post('/content/layanan_pengaduan/update/{id}', [ContentLayananPengaduanController::class, 'update'])->name('konten.layanan_pengaduan.update')->middleware('auth');
Route::delete('/content/layanan_pengaduan/delete/{id}', [ContentLayananPengaduanController::class, 'destroy'])->name('konten.layanan_pengaduan.delete')->middleware('auth');

Route::get('/content/tim_kerja', [ContentTimKerjaController::class, 'index'])->name('konten.tim_kerja.index')->middleware('auth');
Route::get('/content/tim_kerja/data', [ContentTimKerjaController::class, 'getTimKerja'])->name('konten.tim_kerja.data')->middleware('auth');
Route::post('/content/tim_kerja/store', [ContentTimKerjaController::class, 'store'])->middleware('auth');
Route::post('/content/tim_kerja/update/{id}', [ContentTimKerjaController::class, 'update'])->name('konten.tim_kerja.update')->middleware('auth');
Route::delete('/content/tim_kerja/delete/{id}', [ContentTimKerjaController::class, 'destroy'])->name('konten.tim_kerja.delete')->middleware('auth');

Route::get('/content/piagam', [ContentPiagamController::class, 'index'])->name('konten.piagam.index')->middleware('auth');
Route::get('/content/piagam/data', [ContentPiagamController::class, 'getPiagam'])->name('konten.piagam.data')->middleware('auth');
Route::post('/content/piagam/store', [ContentPiagamController::class, 'store'])->middleware('auth');
Route::post('/content/piagam/update/{id}', [ContentPiagamController::class, 'update'])->name('konten.piagam.update')->middleware('auth');
Route::delete('/content/piagam/delete/{id}', [ContentPiagamController::class, 'destroy'])->name('konten.piagam.delete')->middleware('auth');

Route::get('/content/standar_pelayanan', [ContentStandarPelayananController::class, 'index'])->name('konten.standar_pelayanan.index')->middleware('auth');
Route::get('/content/standar_pelayanan/data', [ContentStandarPelayananController::class, 'getStandarPelayanan'])->name('konten.standar_pelayanan.data')->middleware('auth');
Route::post('/content/standar_pelayanan/store', [ContentStandarPelayananController::class, 'store'])->middleware('auth');
Route::post('/content/standar_pelayanan/update/{id}', [ContentStandarPelayananController::class, 'update'])->name('konten.standar_pelayanan.update')->middleware('auth');
Route::delete('/content/standar_pelayanan/delete/{id}', [ContentStandarPelayananController::class, 'destroy'])->name('konten.standar_pelayanan.delete')->middleware('auth');

Route::get('/content/tim_kerja', [ContentTimKerjaController::class, 'index'])->name('konten.tim_kerja.index')->middleware('auth');
Route::get('/content/tim_kerja/data', [ContentTimKerjaController::class, 'getTimKerja'])->name('konten.tim_kerja.data')->middleware('auth');
Route::post('/content/tim_kerja/store', [ContentTimKerjaController::class, 'store'])->middleware('auth');
Route::post('/content/tim_kerja/update/{id}', [ContentTimKerjaController::class, 'update'])->name('konten.tim_kerja.update')->middleware('auth');
Route::delete('/content/tim_kerja/delete/{id}', [ContentTimKerjaController::class, 'destroy'])->name('konten.tim_kerja.delete')->middleware('auth');

Route::get('/content/piagam', [ContentPiagamController::class, 'index'])->name('konten.piagam.index')->middleware('auth');
Route::get('/content/piagam/data', [ContentPiagamController::class, 'getPiagam'])->name('konten.piagam.data')->middleware('auth');
Route::post('/content/piagam/store', [ContentPiagamController::class, 'store'])->middleware('auth');
Route::post('/content/piagam/update/{id}', [ContentPiagamController::class, 'update'])->name('konten.piagam.update')->middleware('auth');
Route::delete('/content/piagam/delete/{id}', [ContentPiagamController::class, 'destroy'])->name('konten.piagam.delete')->middleware('auth');

Route::get('/content/standar_pelayanan', [ContentStandarPelayananController::class, 'index'])->name('konten.standar_pelayanan.index')->middleware('auth');
Route::get('/content/standar_pelayanan/data', [ContentStandarPelayananController::class, 'getStandarPelayanan'])->name('konten.standar_pelayanan.data')->middleware('auth');
Route::post('/content/standar_pelayanan/store', [ContentStandarPelayananController::class, 'store'])->middleware('auth');
Route::post('/content/standar_pelayanan/update/{id}', [ContentStandarPelayananController::class, 'update'])->name('konten.standar_pelayanan.update')->middleware('auth');
Route::delete('/content/standar_pelayanan/delete/{id}', [ContentStandarPelayananController::class, 'destroy'])->name('konten.standar_pelayanan.delete')->middleware('auth');

Route::get('/content/tim_kerja', [ContentTimKerjaController::class, 'index'])->name('konten.tim_kerja.index')->middleware('auth');
Route::get('/content/tim_kerja/data', [ContentTimKerjaController::class, 'getTimKerja'])->name('konten.tim_kerja.data')->middleware('auth');
Route::post('/content/tim_kerja/store', [ContentTimKerjaController::class, 'store'])->middleware('auth');
Route::post('/content/tim_kerja/update/{id}', [ContentTimKerjaController::class, 'update'])->name('konten.tim_kerja.update')->middleware('auth');
Route::delete('/content/tim_kerja/delete/{id}', [ContentTimKerjaController::class, 'destroy'])->name('konten.tim_kerja.delete')->middleware('auth');

Route::get('/content/standar_pelayanan', [ContentStandarPelayananController::class, 'index'])->name('konten.standar_pelayanan.index')->middleware('auth');
Route::get('/content/standar_pelayanan/data', [ContentStandarPelayananController::class, 'getStandarPelayanan'])->name('konten.standar_pelayanan.data')->middleware('auth');
Route::post('/content/standar_pelayanan/store', [ContentStandarPelayananController::class, 'store'])->middleware('auth');
Route::post('/content/standar_pelayanan/update/{id}', [ContentStandarPelayananController::class, 'update'])->name('konten.standar_pelayanan.update')->middleware('auth');
Route::delete('/content/standar_pelayanan/delete/{id}', [ContentStandarPelayananController::class, 'destroy'])->name('konten.standar_pelayanan.delete')->middleware('auth');

Route::get('/content/berita', [ContentBeritaController::class, 'index'])->name('konten.berita.index')->middleware('auth');
Route::get('/content/berita/data', [ContentBeritaController::class, 'getBerita'])->name('konten.berita.data')->middleware('auth');
Route::post('/content/berita/store', [ContentBeritaController::class, 'store'])->name('konten.berita.store')->middleware('auth');
Route::post('/content/berita/update/{id}', [ContentBeritaController::class, 'update'])->name('konten.berita.update')->middleware('auth');
Route::delete('/content/berita/delete/{id}', [ContentBeritaController::class, 'destroy'])->name('konten.berita.delete')->middleware('auth');

Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');
// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Route::get('/berita-show/{id}', [IndexController::class, 'show'])->name('berita.show');
