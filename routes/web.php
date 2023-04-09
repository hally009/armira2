<?php

use Illuminate\Http\Request;
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
Auth::routes();
Route::get('/', function () {
    return view('front.home');
})->name('landing');

Route::post('/setTahun', function (Request $request) {
    session(['tahun' => $request->set_tahun]);
    return redirect()->back();
})->name('set-tahun');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notif/{id}', 'HomeController@notif')->name('notif-redirect');

Route::group(['middleware' => ['auth']],
    function () {
        Route::resource('/user', 'UserController')->only(['show', 'update']);
        Route::put('/user-passsword/{id}', 'UserController@changePasssword')->name('user.password');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'namespace' => 'Satker',
        'prefix' => 'satker',
        'as' => 'Satker::',
    ],
    function () {
        Route::group(
            [
                'middleware' => ['role:' . roles('satker')],
            ],
            function () {
                Route::resource('/admin', 'AdminController');
                Route::get('/admin-password/{id}', 'AdminController@editPassword')->name('admin.edit-password');
                Route::put('/admin-password/{id}', 'AdminController@updatePassword')->name('admin.update-password');
            }
        );
        Route::group(
            [
                'middleware' => ['role:' . roles('satker') . '-' . roles('operator_satker')],
            ],
            function () {
                // Modul Profile
                Route::resource('/dashboard', 'DashboardController');
                Route::resource('/profile', 'ProfileController');
                Route::resource('/pegawai', 'PegawaiController');

                // Modul Master Aset
                Route::resource('/master', 'MasterController');
                Route::post('/master/syncronize', 'MasterController@syncronize')->name('master.syncronize');

                // Modul Perencanaan
                Route::get('/pengadaan/result', 'PengadaanController@result')->name('pengadaan.result');
                Route::resource('/pengadaan', 'PengadaanController');

                Route::get('/pengadaan/{id}/perbaikan', 'PengadaanController@draftPerbaikan')->name('pengadaan.perbaikan.show');
                Route::put('/pengadaan/{id}/perbaikan', 'PengadaanController@updatePerbaikan')->name('pengadaan.perbaikan.update');

                Route::post('/pengadaan/{id}/perbaikan/upload/{nama}', 'PengadaanController@uploadPerbaikan')
                    ->name('pengadaan-perbaikan.upload-file');

                Route::post('/temp-pengadaan', 'TempPengadaanController@store')->name('pengadaan-temp.store');
                Route::post('/temp-pengadaan/upload/{nama}', 'TempPengadaanController@upload')->name('pengadaan-temp.upload-file');
                Route::resource('/pemeliharaan', 'PemeliharaanController')->only(['index']);

                // Modul Pengelolaan
                //psp
                Route::get('/psp/result', 'PspController@result')->name('psp.result');
                Route::resource('/psp', 'PspController');
                Route::get('/psp/{id}/perbaikan', 'PspController@draftPerbaikan')->name('psp.perbaikan.show');
                Route::put('/psp/{id}/perbaikan', 'PspController@updatePerbaikan')->name('psp.perbaikan.update');
                Route::post('/psp/{id}/perbaikan/upload/{nama}', 'PspController@uploadPerbaikan')->name('psp-perbaikan.upload-file');

                //hibah
                Route::get('/hibah/result', 'HibahController@result')->name('hibah.result');
                Route::resource('/hibah', 'HibahController');
                Route::get('/hibah/{id}/perbaikan', 'HibahController@draftPerbaikan')->name('hibah.perbaikan.show');
                Route::put('/hibah/{id}/perbaikan', 'HibahController@updatePerbaikan')->name('hibah.perbaikan.update');
                Route::post('/hibah/{id}/perbaikan/upload/{nama}', 'HibahController@uploadPerbaikan')->name('hibah-perbaikan.upload-file');

                //penghapusan
                Route::get('/penghapusan/get-form/{documentId}/{categoryId}', 'PenghapusanController@getForm');
                Route::get('/penghapusan/get-category/{documentId}', 'PenghapusanController@getCategory');
                Route::get('/penghapusan/result/{documentId}/{categoryId}', 'PenghapusanController@result')->name('penghapusan.result');
                Route::resource('/penghapusan', 'PenghapusanController');
                Route::get('/penghapusan/{id}/perbaikan', 'PenghapusanController@draftPerbaikan')->name('penghapusan.perbaikan.show');
                Route::put('/penghapusan/{id}/perbaikan', 'PenghapusanController@updatePerbaikan')->name('penghapusan.perbaikan.update');
                Route::post('/penghapusan/{id}/perbaikan/upload/{nama}', 'PenghapusanController@uploadPerbaikan')->name('penghapusan-perbaikan.upload-file');

                Route::post('/temp-pengelolaan/{jenis}', 'TempPengelolaanController@store')->name('pengelolaan-temp.store');
                Route::post('/temp-pengelolaan/upload/{jenis}/{nama}', 'TempPengelolaanController@upload')->name('pengelolaan-temp.upload-file');
            }
        );
    }
);

Route::group(
    [
        'middleware' => ['auth', 'role:' . roles('uapb')],
        'namespace' => 'Uapb',
        'prefix' => 'uapb',
        'as' => 'Uapb::',
    ],
    function () {
        // Modul Profile
        Route::resource('/dashboard', 'DashboardController');
        Route::resource('/profile', 'ProfileController');
        Route::resource('/periode', 'PeriodeController');
        Route::put('/periode/{id}/activate', 'PeriodeController@activate')->name('periode.activate');

        Route::resource('/produk', 'ProdukController');
        Route::post('/update-sbsk', 'SbskController@updateSbsk')->name('sbsk.update-sbsk');
        Route::get('/sbsk/show-form', 'SbskController@showForm')->name('sbsk.show-form');;
        Route::resource('/sbsk', 'SbskController');

        Route::resource('/admin', 'AdminController');

        Route::get('/admin-password/{id}', 'AdminController@editPassword')->name('admin.edit-password');
        Route::put('/admin-password/{id}', 'AdminController@updatePassword')->name('admin.update-password');
        Route::group(
            [
                'prefix' => 'satker-request/{tahun}',
            ],
            function () {
                Route::get('/', 'SatkerRequestController@index')->name('satker.request');
                Route::get('/pengadaan/{id}', 'SatkerRequestController@pengadaan')->name('satker.pengadaan');
                Route::get('/perencanaan/{id}', 'SatkerRequestController@pengelolaan')->name('satker.pengelolaan');
            }
        );

        // Modul Master Aset
        Route::resource('/master', 'MasterController');

        // Modul Pengelolaan
        // psp
        Route::resource('/psp', 'PspController');
        Route::put('/psp-agreement/{id}/approve', 'PspAgreementController@approve')->name('psp.approve');
        Route::put('/psp-agreement/{id}/rejected', 'PspAgreementController@rejected')->name('psp.rejected');
        Route::post('/psp-agreement/{id}/upload-sk', 'PspAgreementController@upload')->name('psp.uploadsk');
        Route::put('/psp-agreement/{id}/repeat', 'PspAgreementController@repeat')->name('psp.repeat');
        Route::get('/psp-draft/{id}/', 'PspController@draftPsp')->name('psp.draft');
        Route::get('/psp-draft-word/{id}/', 'PspController@draftPspWord')->name('psp.draft.word');

        // hibah
        Route::resource('/hibah', 'HibahController');
        Route::put('/hibah-agreement/{id}/approve', 'HibahAgreementController@approve')->name('hibah.approve');
        Route::put('/hibah-agreement/{id}/rejected', 'HibahAgreementController@rejected')->name('hibah.rejected');
        Route::put('/hibah-agreement/{id}/repeat', 'HibahAgreementController@repeat')->name('hibah.repeat');
        Route::post('/hibah-agreement/{id}/upload-sk', 'HibahAgreementController@upload')->name('hibah.uploadsk');
        Route::get('/hibah-draft/{id}/', 'HibahController@draftHibah')->name('hibah.draft');
        Route::get('/hibah-draft-word/{id}/', 'HibahController@draftHibahWord')->name('hibah.draft.word');

        // penghapusan
        Route::resource('/penghapusan', 'PenghapusanController');
        Route::put('/penghapusan-agreement/{id}/approve', 'PenghapusanAgreementController@approve')->name('penghapusan.approve');
        Route::put('/penghapusan-agreement/{id}/rejected', 'PenghapusanAgreementController@rejected')->name('penghapusan.rejected');
        Route::put('/penghapusan-agreement/{id}/repeat', 'PenghapusanAgreementController@repeat')->name('penghapusan.repeat');
        Route::post('/penghapusan-agreement/{id}/upload-sk', 'PenghapusanAgreementController@upload')->name('penghapusan.uploadsk');
        Route::get('/penghapusan-draft/{id}', 'PenghapusanController@draftPenghapusan')->name('penghapusan.draft');
        Route::get('/penghapusan-draft-word/{id}', 'PenghapusanController@draftPenghapusanWord')->name('penghapusan.draft.word');

        // Modul Perencanaan
        Route::resource('/pengadaan', 'PengadaanController');
        Route::post('/pengadaan-agreement/upload-sk', 'PengadaanAgreementController@upload')->name('pengadaan.uploadsk');
        Route::put('/pengadaan-agreement/{id}/approve', 'PengadaanAgreementController@approve')->name('pengadaan.approve');
        Route::put('/pengadaan-agreement/{id}/rejected', 'PengadaanAgreementController@rejected')->name('pengadaan.rejected');
        Route::put('/pengadaan-agreement/{id}/repeat', 'PengadaanAgreementController@repeat')->name('pengadaan.repeat');
        Route::get('/pengadaan-draft', 'PengadaanController@draftPengadaan')->name('pengadaan.draft');
        Route::get('/pengadaan-draft-word/{id}', 'PengadaanController@draftPengadaanWord')->name('pengadaan.draft.word');

    }
);

Route::group(
    [
        'middleware' => ['auth', 'role:' . roles('apip')],
        'namespace' => 'Apip',
        'prefix' => 'apip',
        'as' => 'Apip::',
    ],
    function () {
        // Modul Profile
        Route::resource('/dashboard', 'DashboardController');
        Route::resource('/profile', 'ProfileController');

        // Modul Master Aset
        Route::resource('/master', 'MasterController');

        // Modul Perencanaan
        Route::resource('/pengadaan', 'PengadaanController');
    }
);
