<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['verify' => true]);


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get("/getkabupaten/{id}", "Auth\RegisterController@kabupaten_baru");
Route::get("/getkecamatan/{id}", "Auth\RegisterController@kecamatan_baru");
Route::get("/getdesa/{id}", "Auth\RegisterController@desa_baru");


Route::get('account/password', 'Account\PasswordController@edit')->name('password.edit');
Route::patch('account/password', 'Account\PasswordController@update')->name('password.edit');

Route::group(
    ['middleware' => 'auth'],
    function () {
        // MODUL FRONT OFFICE
        // DASHBOARD
        Route::prefix('frontoffice')
            ->namespace('FrontOffice')
            ->middleware(['admin_front_office', 'verified'])
            ->group(function () {
                Route::get('/', 'DashboardFrontOfficeController@index')
                    ->name('dashboardfrontoffice');
            });

        // MASTER DATA JENIS KENDARAAN
        Route::prefix('frontoffice')
            ->namespace('FrontOffice')
            ->middleware(['admin_front_office', 'verified'])
            ->group(function () {
                Route::resource('jenis-kendaraan', 'MasterDataJenisKendaraanController');
                Route::resource('jenis-perbaikan', 'MasterDataJenisPerbaikanController');
                Route::resource('diskon', 'MasterDataDiskonController');
                Route::resource('pitstop', 'MasterDataPitstopController');
                Route::resource('reminder', 'MasterDataReminderController');
                Route::resource('faq', 'MasterDataFAQController');
                Route::resource('merk-kendaraan', 'MasterDataMerkKendaraanController');
                Route::resource('kendaraan', 'MasterDataKendaraanController');
                Route::resource('harga-jual', 'HargaJualSparepartController');
            });


        //  DATA PELAYANAN SERVICE
        Route::prefix('frontoffice')
            ->namespace('FrontOffice')
            ->middleware(['admin_front_office', 'verified'])
            ->group(function () {
                Route::resource('pelayananservice', 'PelayananServiceController');
                Route::resource('customerterdaftar', 'CustomerBengkelController');
                Route::resource('penjualansparepart', 'PenjualanSparepartController');
                Route::put('/pengerjaan/{id}', 'PelayananServiceController@status')
                    ->name('dikerjakan');
                Route::get('/cetak-work-order/{id}', 'PelayananServiceController@cetakWorkOrder')->name('cetak-wo');
                Route::get('/cetak-invoice-sparepart/{id}', 'PenjualanSparepartController@cetakSparepart')->name('cetak-sparepart');
            });
    }
);
