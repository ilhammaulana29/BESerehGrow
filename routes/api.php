<?php

use App\Http\Controllers\FraksinasiController;
use App\Http\Controllers\GalleryController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Admin Acces Management


//LandAnalis
use App\Http\Controllers\AnalisisLahanController;




use App\Http\Controllers\helpController;
use App\Http\Controllers\ProsedurAnalisisController;

//Cultivate Management

//Procesing Management

//Company & Mitra
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Company_addressController;
use App\Http\Controllers\Cpc_aboutController;
use App\Http\Controllers\Cpc_company_historyController;
use App\Http\Controllers\Cpc_company_contactController;
use App\Http\Controllers\Mitracontroller;
use App\Http\Controllers\PenyulinganController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\PengujianController;

//Koperasi
use App\Http\Controllers\JenisSimpananController;
use App\Http\Controllers\StatuskeanggotaanController;
use App\Http\Controllers\PendaftaranController;

//Konten
use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\ContentController;

Route::get('/budidaya', [BudidayaController::class, 'index']);
Route::get('/budidaya/{id}', [BudidayaController::class, 'show']);
Route::post('/budidaya', [BudidayaController::class, 'store']);
Route::put('/budidaya/{id}', [BudidayaController::class, 'update']);
Route::delete('/budidaya/{id}', [BudidayaController::class, 'destroy']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Admin Acces Management


//LandAnalis
Route::get('/analisis-lahan', [AnalisisLahanController::class, 'index']);
Route::post('/analisis-lahan', [AnalisisLahanController::class, 'store']);
Route::delete('/analisis-lahan/{id_analisislahan}', [AnalisisLahanController::class, 'destroy']);
Route::get('/proseduranalisis', [ProsedurAnalisisController::class, 'index']);
Route::post('/proseduranalisis', [ProsedurAnalisisController::class, 'store']);
Route::get('proseduranalisis/{jenis_konten}', [ProsedurAnalisisController::class, 'getByJenisKonten']);
Route::put('proseduranalisis/{id}', [ProsedurAnalisisController::class, 'update']);
Route::get('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'show']);
Route::delete('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'destroy']);



//Cultivate Management
use App\Http\Controllers\LandController;


Route::post('/bloklahan', [LandController::class, 'store']);
Route::get('/bloklahan', [LandController::class, 'index']);
Route::get('/bloklahan/namablok', [LandController::class, 'getNamaBlok']);
Route::put('/bloklahan/{id}', [LandController::class, 'update']); // Mengupdate data
Route::delete('/bloklahan/{id}', [LandController::class, 'destroy']);
Route::get('/bloklahan/jenisRumpun/{nama_blok}', [LandController::class, 'getJenisRumpun']);


use App\Http\Controllers\PenyulamanController;

Route::post('/penyulaman', [PenyulamanController::class, 'store']);
Route::get('/penyulaman', [PenyulamanController::class, 'index']);
Route::put('/penyulaman/{id}', [PenyulamanController::class, 'update']); // Mengupdate data
Route::delete('/penyulaman/{id}', [PenyulamanController::class, 'destroy']);

use App\Http\Controllers\AreaRindangController;


Route::get('arearindang', [AreaRindangController::class, 'index']);
Route::post('arearindang', [AreaRindangController::class, 'store']);
Route::get('arearindang/{id}', [AreaRindangController::class, 'show']);
Route::put('arearindang/{id}', [AreaRindangController::class, 'update']);
Route::delete('arearindang/{id}', [AreaRindangController::class, 'destroy']);

use App\Http\Controllers\PemupukanController;
use App\Http\Controllers\TumpangsariController;

// Pemupukan Routes
Route::get('pemupukan', [PemupukanController::class, 'index']);
Route::post('pemupukan', [PemupukanController::class, 'store']);
Route::get('pemupukan/{id}', [PemupukanController::class, 'show']);
Route::put('pemupukan/{id}', [PemupukanController::class, 'update']);
Route::delete('pemupukan/{id}', [PemupukanController::class, 'destroy']);

// Tumpangsari Routes
Route::get('tumpangsari', [TumpangsariController::class, 'index']);
Route::post('tumpangsari', [TumpangsariController::class, 'store']);
Route::get('tumpangsari/{id}', [TumpangsariController::class, 'show']);
Route::put('tumpangsari/{id}', [TumpangsariController::class, 'update']);
Route::delete('tumpangsari/{id}', [TumpangsariController::class, 'destroy']);

use App\Http\Controllers\RumpunController;

Route::apiResource('rumpun', RumpunController::class);

use App\Http\Controllers\PanenController;
use App\Http\Controllers\PendaftaranAlamatAnggotaKoperasiController;
use App\Http\Controllers\PendaftaranAnggotaKoperasiController;

// Route::get('panen', [PanenController::class, 'index']);
// Route::get('panen/{id}', [PanenController::class, 'show']);
// Route::post('panen', [PanenController::class, 'store']);
// Route::put('panen/{id}', [PanenController::class, 'update']);
// Route::delete('panen/{id}', [PanenController::class, 'destroy']);
Route::apiResource('panen', PanenController::class);


use App\Http\Controllers\PlasmaController;
use App\Http\Controllers\SimpananAnggotaKoperasiController;

// Route::get('plasma', [PlasmaController::class, 'index']);
// Route::get('plasma/{id}', [PlasmaController::class, 'show']);
// Route::post('plasma', [PlasmaController::class, 'store']);
// Route::put('plasma/{id}', [PlasmaController::class, 'update']);
// Route::delete('plasma/{id}', [PlasmaController::class, 'destroy']);
Route::apiResource('plasma', PlasmaController::class);
// Route::put('/plasma/{id}', [PlasmaController::class, 'update']);

//Procesing Management
Route::get('/penyulingan', [PenyulinganController::class, 'index']);
Route::get('/penyulingan/{status}', [PenyulinganController::class, 'getByStatus']);
Route::post('/penyulingan', [PenyulinganController::class, 'store']);
Route::put('/penyulingan/{id_penyulingan}', [PenyulinganController::class, 'update']);
Route::delete('/penyulingan/{id_penyulingan}', [PenyulinganController::class, 'destroy']);
Route::put('/penyulingan/{id_penyulingan}/status', [PenyulinganController::class, 'updateStatus']);
Route::get('/penyulingan/masuk-gudang/{status}', [PenyulinganController::class, 'getMasukGudang']);
Route::get('/pengujian/fraksinasi/{status}', [PengujianController::class, 'getSiapFraksinasi']);
Route::post('/pengujian/tambahdata', [PengujianController::class, 'store']);
Route::get('/pengujian/table', [PengujianController::class, 'index']);
Route::put('/pengujian/{id_pengujian}', [PengujianController::class, 'update']);
Route::delete('/pengujian/{id_pengujian}', [PengujianController::class, 'destroy']);
Route::get('/penyulingan/table/{id_penyulingan}', [PenyulinganController::class,'getByPenyulinganId']);
Route::get('/pengujian/table/{id_penyulingan}', [PengujianController::class,'getByPenyulinganId']);
Route::put('/pengujian/{id_pengujian}/status', [PengujianController::class, 'updateStatus']);
Route::post('/fraksinasi/tambahdata', [FraksinasiController::class, 'store']);
Route::get('/fraksinasi/table', [FraksinasiController::class, 'index']);
Route::put('/fraksinasi/{id_fraksinasi}', [FraksinasiController::class, 'update']);
Route::delete('/fraksinasi/{id_fraksinasi}', [FraksinasiController::class, 'destroy']);
Route::get('/keluhan', [KeluhanController::class, 'index']);
Route::post('/keluhan', [KeluhanController::class, 'store']);
Route::put('/keluhan/{id_keluhan}', [KeluhanController::class, 'update']); // Mengupdate keluhan berdasarkan ID
Route::delete('/keluhan/{id_keluhan}', [KeluhanController::class, 'destroy']);

//Koperasi
Route::post('koperasi/statuskeanggotaan', [StatuskeanggotaanController::class,'store']);
Route::get('koperasi/statuskeanggotaan/table', [StatuskeanggotaanController::class,'index']);
Route::put('koperasi/statuskeanggotaan/{id_statusanggota}', [StatuskeanggotaanController::class,'update']);
Route::delete('koperasi/statuskeanggotaan/{id_statusanggota}', [StatuskeanggotaanController::class,'destroy']);
Route::get('/koperasi/pendaftaran-anggota/statusanggota', [StatuskeanggotaanController::class, 'getStatusAnggota']);
Route::get('/koperasi/pendaftaran-anggota/jenissimpanan', [JenisSimpananController::class, 'getJenisSimpanan']);
Route::get('koperasi/memberdata',[PendaftaranAnggotaKoperasiController::class, 'index']);
// Route untuk anggota koperasi
Route::post('/koperasi/pendaftaran/anggota', [PendaftaranController::class, 'store']);
Route::put('/koperasi/memberdata/edit/{id_anggota}',[PendaftaranAnggotaKoperasiController::class, 'update']);
Route::put('/koperasi/memberdata/delete/{id_anggota}',[PendaftaranAnggotaKoperasiController::class, 'destroy']);
Route::get('/koperasi/detail-memberdata/{id_anggota}', [PendaftaranAnggotaKoperasiController::class,'getByMemberId']);

Route::get('/koperasi/detail-memberdata/statusanggota/{id_statusanggota}', [StatuskeanggotaanController::class,'getByStatusMemberId']);
Route::get('/koperasi/detail-memberdata/alamat/{id_anggota}', [PendaftaranAlamatAnggotaKoperasiController::class, 'getAlamatByMemberId']);
Route::get('koperasi/saving-memberdata/{id_anggota}', [SimpananAnggotaKoperasiController::class, 'getMemberSavingData']);
Route::put('/koperasi/detail-memberdata/alamat/edit/{id_anggota}', [PendaftaranAlamatAnggotaKoperasiController::class, 'update']);
Route::get('/koperasi/simpanan-anggota', [SimpananAnggotaKoperasiController::class, 'getAllSavingsData']);
Route::get('/koperasi/simpanan-anggota/filter', [SimpananAnggotaKoperasiController::class, 'etFilteredSavingsData']);
Route::get('/koperasi/member-saving/namaAnggota', [PendaftaranAnggotaKoperasiController::class, 'getNamaAnggota']);
Route::post('/koperasi/member-saving', [SimpananAnggotaKoperasiController::class, 'store']);
Route::put('/koperasi/member-saving/edit/{id_simpanan}', [SimpananAnggotaKoperasiController::class, 'update']);
Route::delete('/koperasi/member-saving/delete/{id_simpanan}', [SimpananAnggotaKoperasiController::class, 'destroy']);



//Konten
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/showgallery/{id_galeri}', [GalleryController::class, 'showDataGallery']);
Route::get('/categories', [GalleryController::class, 'getCategories']);
Route::post('/upload-gallery', [GalleryController::class, 'uploadGallery']);

//Company
Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

//Company_address
Route::get('/company-address', [Company_addressController::class,'index']);
Route::post('/company-address', [Company_addressController::class, 'store']);
Route::get('/company-address/{id}', [Company_addressController::class,   'show']);
Route::put('/company-address/{id}', [Company_addressController::class,'update']);
Route::delete('/company-address/{id}', [Company_addressController::class, 'destroy']);

//Company_about
Route::get('/company-about', [Cpc_aboutController::class, 'index']);
Route::post('/company-about', [Cpc_aboutController::class, 'store']);
Route::get('/company-about/{id}', [Cpc_aboutController::class, 'show']);
Route::put('/company-about/{id}', [Cpc_aboutController::class, 'update']);
Route::delete('/company-about/{id}', [Cpc_aboutController::class, 'destroy']);

//Company_Contact
Route::get('/company-contact', [Cpc_company_contactController::class, 'index']);
Route::post('/company-contact', [Cpc_company_contactController::class, 'store']);
Route::get('/company-contact/{id}', [Cpc_company_contactController::class,'show']);
Route::put('/company-contact/{id}', [Cpc_company_contactController::class, 'update']);
Route::delete('/company-contact/{id}', [Cpc_company_contactController::class,  'destroy']);

//Company_History
Route::get('/company-history', [Cpc_company_historyController::class, 'index']);
Route::post('/company-history', [Cpc_company_historyController::class, 'store']);
Route::get('/company-history/{id}', [Cpc_company_historyController::class, 'show']);
Route::put('/company-history/{id}', [Cpc_company_historyController::class, 'update']);
Route::delete('/company-history/{id}', [Cpc_company_historyController::class, 'destroy']);

//mitra
Route::get('/mitra', [Mitracontroller::class, 'index']);        // GET semua mitra
Route::post('/mitra', [Mitracontroller::class, 'store']);       // POST buat mitra baru
Route::get('/mitra/{id}', [Mitracontroller::class, 'show']);     // GET satu mitra
Route::put('/mitra/{id}', [Mitracontroller::class, 'update']);   // PUT update mitra
Route::delete('/mitra/{id}', [Mitracontroller::class, 'destroy']); // DELETE hapus mitra

Route::put('/gallery/{id_galeri}', [GalleryController::class, 'updateGallery']);
Route::delete('/gallery/{id_galeri}', [GalleryController::class, 'deleteGallery']);



//Help
Route::get('/help', [helpController::class, 'index']);
Route::post('/add-help', [helpController::class, 'addHelp']);
Route::put('/edit-help/{id}', [helpController::class, 'updateHelp']);
Route::delete('/delete-help/{id}', [helpController::class, 'deleteHelp']);




Route::get('/article-content', [ContentController::class, 'index']);
Route::get('/show-article-content/{id_konten}', [ContentController::class, 'showDataContent']);
Route::put('/edit-article-content/{id_konten}', [ContentController::class, 'updateContent']);
Route::get('/article-content/{slug}', [ContentController::class, 'detailContent']);
Route::get('/type-content', [ContentController::class, 'getContentType']);
route::post('/upload-content', [ContentController::class, 'uploadContent']);
Route::delete('/article-content/{id_konten}', [ContentController::class, 'deleteContent']);
