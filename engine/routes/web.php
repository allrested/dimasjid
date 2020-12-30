<?php

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

// Route::get('/', function(){
//     return view('welcome');
// });

Route::get('/', 'LandingController@index');

// Deploy Webhook
Route::post('/deploy/github', 'DeployController@github');

// layanan
Route::get('layanan', 'LayananController@layanan');
Route::post('layanan/daftar_masjid', 'LayananController@daftarMasjid');
Route::get('layanan/masjid_daerah', 'LayananController@dataAjax');

// informasi
Route::get('informasi', 'InformasiController@informasi');

// berita
Route::get('berita', 'BeritaController@berita');
Route::get('detail_berita/{slug}', 'BeritaController@detail_berita');
Route::post('add_comments','BeritaController@add_comments');

// kontak
Route::resource('kontak_kami', 'KontakController');

//agenda
Route::get('agenda','AgendaController@index');
Route::get('agenda/{id}','AgendaController@show');

// auth
Route::get('/forgot_pass','Auth\ForgotPasswordController@index');
Route::post('/reset_pass','Auth\ForgotPasswordController@reset');

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('print', 'LaporanController@print')->name('print');
});

Auth::routes();

//Admin
Route::middleware('auth')->prefix('admin')->group(function(){

    Route::get('/', 'Admin\DashboardController@index');
    
    Route::prefix('anggaran')->name('anggaran.')->group(function () {
        Route::resource('penerimaan', 'Admin\Anggaran\PenerimaanController');
        Route::resource('pengeluaran', 'Admin\Anggaran\PengeluaranController');
        Route::resource('saldo', 'Admin\Anggaran\SaldoController');
        Route::get('saldo-masjid', 'Admin\Anggaran\SaldoController@dataMasjid')->name('saldo.masjid');
        Route::get('saldo-akun', 'Admin\Anggaran\SaldoController@dataAkun')->name('saldo.akun');
        Route::post('saldo-all', 'Admin\Anggaran\SaldoController@getAll')->name('saldo.all');
        Route::post('print', 'LaporanController@print')->name('print');
    });

    // Master
    Route::resource('akun', 'Admin\Master\AkunController');
    Route::get('akun-all', 'Admin\Master\AkunController@getData')->name('akun.all');
    Route::resource('masjid', 'Admin\Master\MasjidController');
    Route::get('masjid-all', 'Admin\Master\MasjidController@getData')->name('masjid.all');
    Route::get('masjid-daerah', 'Admin\Master\MasjidController@dataAjax')->name('masjid.daerah');
    // CMS
    Route::resource('users', 'Admin\Content\UserController');
    Route::post('users-active', 'Admin\Content\UserController@active')->name('users.active');
    Route::resource('banner', 'Admin\Content\BannerController');
    Route::resource('announce', 'Admin\Content\AnnounceController');
    Route::resource('agenda', 'Admin\Content\AgendaController');
    Route::resource('berita', 'Admin\Content\BeritaController');
    Route::resource('album', 'Admin\Content\AlbumController');
    Route::resource('gallery', 'Admin\Content\GalleryController');
    Route::resource('videos', 'Admin\Content\VideoController');
    Route::resource('links', 'Admin\Content\LinkController');
    Route::resource('informasi-publik', 'Admin\Content\InformasiPublikController');
    Route::get('comments','Admin\Content\CommentsController@index')->name('comments.index');
    Route::get('kontak_kami', 'Admin\Content\KontakKamiController@index')->name('admin-kontak-kami.index');

    Route::get('album/{id}/gallery', 'Admin\Content\AlbumController@listGallery');
    Route::get('album/{id}/createGallery', 'Admin\Content\AlbumController@listGallery');

    Route::patch('berita/{berita}/approve', 'Admin\Content\BeritaController@approve')->name('berita.approve');

});
