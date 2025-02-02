<?php

use App\Http\Controllers\FraksinasiController;
use App\Http\Controllers\GalleryController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Admin Acces Management
use App\Http\Controllers\AdminController;

Route::post('/admins', [AdminController::class, 'store']);

use App\Http\Controllers\DashboardACMController;

Route::get('/dashboard/summary', [DashboardACMController::class, 'getSummary']);


use App\Http\Controllers\PasswordResetController;

Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});
Route::get('/admins', [AdminController::class, 'index']);
Route::get('/admins/{id}', [AdminController::class, 'show']);
Route::put('/admins/{id}', [AdminController::class, 'update']);
Route::delete('/admins/{id}', [AdminController::class, 'destroy']);

use App\Http\Controllers\AdminPermitController;

Route::get('/admin-permits', [AdminPermitController::class, 'index']);

use App\Http\Controllers\KaryawanController;

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']);

use App\Http\Controllers\AgendaPanenController;

Route::get('/agenda-panen', [AgendaPanenController::class, 'index']);
Route::post('/agenda-panen', [AgendaPanenController::class, 'store']);

use App\Http\Controllers\StatistikController;

Route::get('/stats', [StatistikController::class, 'getStats']);


//LandAnalis
use App\Http\Controllers\AnalisisLahanController;
use App\Http\Controllers\AturParameterKalkulasiController;




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
use App\Http\Controllers\GrafikPenyulinganController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\PengujianSerehwangiController;
use App\Http\Controllers\HasilPemeriksaanController;
use App\Http\Controllers\PengemasanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\GrafikDistribusiBarangController;

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
Route::get('/kalkulasi/count-kalkulasi', [AnalisisLahanController::class, 'countAnalisislahan']);
Route::post('/analisis-lahan', [AnalisisLahanController::class, 'store']);
Route::get('/join-hasil-kalkulasi-data', [AnalisisLahanController::class, 'getJoinedData']);
Route::get('/cari-data-hasil-kalkulasi-potensi-lahan', [AnalisisLahanController::class, 'searchKalkulasiLahan']);
Route::get('/produksi-daun-grafik', [AnalisisLahanController::class, 'latestProduksiDaunData']);
Route::get('/sort-kalkulasi-lahan', [AnalisisLahanController::class, 'sortKalkulasiLahan']);
Route::get('/kalkulasi-data-simulasi/{id_kalkulasi}', [AnalisisLahanController::class, 'show']);

Route::delete('/analisis-lahan/{id_analisislahan}', [AnalisisLahanController::class, 'destroy']);
Route::get('/proseduranalisis', [ProsedurAnalisisController::class, 'index']);
Route::post('/proseduranalisis', [ProsedurAnalisisController::class, 'store']);
Route::get('proseduranalisis/{jenis_konten}', [ProsedurAnalisisController::class, 'getByJenisKonten']);
Route::put('/ubah-deskripsi/{id}', [ProsedurAnalisisController::class, 'updateData']);
Route::put('/ubah-gambar/{id}', [ProsedurAnalisisController::class, 'updateGambar']);
Route::get('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'show']);
Route::delete('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'destroy']);

Route::get('/parameter-kalkulasi-lahan/tabledata',[AturParameterKalkulasiController::class, 'index']);
Route::put('/pilih-parameter/{id_parameter}',[AturParameterKalkulasiController::class, 'updateTimestampById']);
Route::get('/parameter-kalkulasi-lahan/data',[AturParameterKalkulasiController::class, 'show']);
Route::post('/parameter-kalkulasi-lahan/tambah',[AturParameterKalkulasiController::class, 'store']);
Route::put('/parameter-kalkulasi-lahan/ubah/{id_parameter}',[AturParameterKalkulasiController::class, 'update']);
Route::delete('/parameter-kalkulasi-lahan/hapus/{id_parameter}',[AturParameterKalkulasiController::class, 'destroy']);
Route::get('/parameter-kalkulasi-simulasi/{id_parameter}',[AturParameterKalkulasiController::class, 'showById']);

Route::get('/prosedur-lahan/count-persiapanlahan', [ProsedurAnalisisController::class, 'countByJenisProsedurLahan']);
Route::get('/prosedur-penanaman/count-prosedurpenanaman', [ProsedurAnalisisController::class, 'countByJenisProsedurPenanaman']);
Route::get('/prosedur-perawatan/count-prosedurperawatan', [ProsedurAnalisisController::class, 'countByJenisProsedurPerawatan']);
Route::get('/prosedur-panen/count-prosedurpanen', [ProsedurAnalisisController::class, 'countByJenisProsedurPanen']);
Route::get('/prosedur-penyulingan/count-penyulingan', [ProsedurAnalisisController::class, 'countByJenisProsedurPenyulingan']);
Route::get('/alat-penyulingan/count-alatpenyulingan', [ProsedurAnalisisController::class, 'countByJenisProsedurAlatPenyulingan']);
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
use App\Http\Controllers\KontenBudidayaController;
use App\Http\Controllers\LandingPageController;


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

use App\Http\Controllers\JenisRumpunController;

Route::apiResource('jenis-rumpun', JenisRumpunController::class);



use App\Http\Controllers\PanenController;
use App\Http\Controllers\PendaftaranAlamatAnggotaKoperasiController;
use App\Http\Controllers\PendaftaranAnggotaKoperasiController;
use App\Http\Controllers\PinjamanAnggotaController;
use App\Http\Controllers\AngsuranAnggotaController;


Route::apiResource('panen', PanenController::class);


use App\Http\Controllers\PlasmaController;
use App\Http\Controllers\SimpananAnggotaKoperasiController;
use Illuminate\Routing\RouteUri;

Route::apiResource('plasma', PlasmaController::class);

//Procesing Management
Route::get('/penyulingan', [PenyulinganController::class, 'index']);
Route::get('/penyulingan/{status}', [PenyulinganController::class, 'getByStatus']);
Route::post('/penyulingan', [PenyulinganController::class, 'store']);
Route::put('/penyulingan/{id_penyulingan}', [PenyulinganController::class, 'update']);
Route::delete('/penyulingan/{id_penyulingan}', [PenyulinganController::class, 'destroy']);
Route::put('/penyulingan/{id_penyulingan}/status', [PenyulinganController::class, 'updateStatus']);
Route::get('/penyulingan/masuk-gudang/{status}', [PenyulinganController::class, 'getMasukGudang']);
Route::get('/grafik-penyulingan', [GrafikPenyulinganController::class, 'latestPenyulinganData']);

Route::post('/pengujian/tambahdata', [PengujianSerehwangiController::class, 'store']);
Route::get('/pengujian/table', [PengujianSerehwangiController::class, 'index']);
Route::put('/pengujian/{id_pengujian}', [PengujianSerehwangiController::class, 'update']);
Route::delete('/pengujian/{id_pengujian}', [PengujianSerehwangiController::class, 'destroy']);
Route::get('/pengujian/count-pengujian', [PengujianSerehwangiController::class, 'countPengujian']);
Route::get('/cara-data-pengujian', [PengujianSerehwangiController::class, 'searchPengujian']);

Route::get('/penyulingan/table/{id_penyulingan}', [PenyulinganController::class,'getByPenyulinganId']);
Route::get('/penyulingan/batch-penyulingan/{id_penyulingan}', [PenyulinganController::class,'getByPenyulinganBatchId']);
Route::get('/penyulingan/count-status/SiapSetor', [PenyulinganController::class, 'countByStatusSiapSetor']);
Route::get('/penyulingan/count-status/MasukGudang', [PenyulinganController::class, 'countByStatusMasukGudang']);
Route::get('/penyulingan/menghitung-penyulingan', [PenyulinganController::class, 'getCountPenyulingan']);
Route::get('/cari-data-penyulingan/siap-setor', [PenyulinganController::class, 'searchPenyulinganSiapSetor']);
Route::get('/cari-data-penyulingan/masuk-gudang', [PenyulinganController::class, 'searchPenyulinganMasukGudang']);
Route::get('/sort-penyulingan/siap-setor', [PenyulinganController::class, 'sortPenyulinganSiapSetor']);
Route::get('/sort-penyulingan/masuk-gudang', [PenyulinganController::class, 'sortPenyulinganMasukGudang']);

Route::get('/pengujian/data/{id_pengujian}', [PengujianSerehwangiController::class,'getByPengujianId']);
Route::get('/sort-pengujian-data', [PengujianSerehwangiController::class,'sortPengujian']);
Route::get('/pengujian/options', [PengujianSerehwangiController::class,'getAllKodeBahan']);
Route::get('/penyulingan/pengujian-data/{id_penyulingan}', [PengujianSerehwangiController::class,'getPengujianByPenyulinganId']);
Route::get('/hasil-pemeriksaan/data/{id_pengujian}', [HasilPemeriksaanController::class, 'getHasilPemeriksaanByIdPengujian']);
Route::post('/hasil-pemeriksaan/tambah-data', [HasilPemeriksaanController::class, 'store']);
Route::put('/hasil-pemeriksaan/ubah-data/{id_hasil_pemeriksaan}', [HasilPemeriksaanController::class, 'update']);
Route::delete('/hasil-pemeriksaan/delete-data/{id_hasil_pemeriksaan}', [HasilPemeriksaanController::class, 'destroy']);

Route::get('/pengemasan/table', [PengemasanController::class, 'tableFilter']);
Route::post('/pengemasan/tambah-data', [PengemasanController::class, 'store']);
Route::put('/pengemasan/ubah-data/{id_pengemasan}', [PengemasanController::class, 'update']);
Route::delete('/pengemasan/delete-data/{id_pengemasan}', [PengemasanController::class, 'destroy']);
Route::get('/pengemasan/options', [PengemasanController::class, 'getAllKodeKemasan']);
Route::put('/pengemasan/penyetoran/{id_pengemasan}', [PengemasanController::class, 'getSetorkan']);
Route::put('/pengemasan/penjualan/{id_pengemasan}', [PengemasanController::class, 'getJualkan']);
Route::get('/pengemasan/count-pengemasan', [PengemasanController::class, 'countPengemasan']);
Route::get('/pengemasan/count-pengemasan/dalam-proses', [PengemasanController::class, 'countByStatusDalamProses']);
Route::get('/pengemasan/count-pengemasan/tersedia', [PengemasanController::class, 'countByStatusTersedia']);
Route::get('/pengemasan/count-pengemasan/terjual', [PengemasanController::class, 'countByStatusTerjual']);
Route::get('/cari-data-pengemasan/dalamproses', [PengemasanController::class, 'searchPengemasanDalamProses']);
Route::get('/cari-data-pengemasan/tersedia', [PengemasanController::class, 'searchPengemasanTersedia']);
Route::get('/cari-data-pengemasan/terjual', [PengemasanController::class, 'searchPengemasanTerjual']);
Route::get('/sort-pengemasan-data/dalamproses', [PengemasanController::class, 'sortPengemasanDalamProses']);
Route::get('/sort-pengemasan-data/tersedia', [PengemasanController::class, 'sortPengemasanTersedia']);
Route::get('/sort-pengemasan-data/terjual', [PengemasanController::class, 'sortPengemasanTerjual']);


Route::get('/data-stok/table', [StokController::class, 'tableStokFilter']);
Route::post('/data-stok/tambah-data', [StokController::class, 'store']);
Route::put('/data-stok/ubah-data/{id_stok}', [StokController::class, 'update']);
Route::delete('/data-stok/delete-data/{id_stok}', [StokController::class, 'destroy']);
Route::get('/data-stok/pengemasan/table', [StokController::class, 'getStokWithPengemasan']);
Route::put('/data-stok/keluarkan/{id_stok}', [StokController::class, 'getKeluarkan']);
Route::get('/data-stok/count-stok/tersedia', [StokController::class, 'countByStatusStokTersedia']);
Route::get('/data-stok/count-stok/keluar', [StokController::class, 'countByStatusStokKeluar']);
Route::get('/cari-data-stok/tersedia', [StokController::class, 'searchStokTersedia']);
Route::get('/cari-data-stok/keluar', [StokController::class, 'searchStokKeluar']);
Route::get('/sort-stok-data/tersedia', [StokController::class, 'sortStokTersedia']);
Route::get('/sort-stok-data/keluar', [StokController::class, 'sortStokKeluar']);

Route::get('/pendistribusian/table', [DistribusiController::class, 'index']);
Route::post('/pendistribusian/tambah-data', [DistribusiController::class, 'store']);
Route::put('/pendistribusian/ubah-data/{id_distribusi}', [DistribusiController::class, 'update']);
Route::delete('/pendistribusian/delete-data/{id_distribusi}', [DistribusiController::class, 'destroy']);
Route::get('/pendistribusian/data-pengemasan', [DistribusiController::class, 'getDistributWithPengemasan']);
Route::put('/pendistribusian/pengiriman/{id_distribusi}', [DistribusiController::class, 'getDelivery']);
Route::put('/pendistribusian/pengiriman-selesai/{id_distribusi}', [DistribusiController::class, 'getFinish']);
Route::get('/pengemasan/count-distribusi/pending', [DistribusiController::class, 'countByStatusDistribusiPending']);
Route::get('/pengemasan/count-distribusi/dikirim', [DistribusiController::class, 'countByStatusDistribusiDikirim']);
Route::get('/pengemasan/count-distribusi/selesai', [DistribusiController::class, 'countByStatusDistribusiSelesai']);
Route::get('/grafik-distribusi-barang', [GrafikDistribusiBarangController::class, 'grafikDistribusi']);
Route::get('/cari-data-pendistribusian/pending', [DistribusiController::class, 'searchDistribusiPending']);
Route::get('/cari-data-pendistribusian/dikirim', [DistribusiController::class, 'searchDistribusiDikirim']);
Route::get('/cari-data-pendistribusian/selesai', [DistribusiController::class, 'searchDistribusiSelesai']);
Route::get('/sort-distribusi-data/pending', [DistribusiController::class, 'sortDistribusiPending']);
Route::get('/sort-distribusi-data/dikirim', [DistribusiController::class, 'sortDistribusiDikirim']);
Route::get('/sort-distribusi-data/selesai', [DistribusiController::class, 'sortDistribusiSelesai']);

Route::post('/fraksinasi/tambahdata', [FraksinasiController::class, 'store']);
Route::get('/fraksinasi/table', [FraksinasiController::class, 'index']);
Route::get('/fraksinasi/count-fraksinasi', [FraksinasiController::class, 'countFraksinasi']);
Route::put('/fraksinasi/{id_fraksinasi}', [FraksinasiController::class, 'update']);
Route::delete('/fraksinasi/{id_fraksinasi}', [FraksinasiController::class, 'destroy']);
Route::get('/cari-data-fraksinasi', [FraksinasiController::class, 'searchFraksinasi']);
Route::get('/sort-fraksinasi-data', [FraksinasiController::class, 'sortFraksinasi']);

Route::get('/keluhan', [KeluhanController::class, 'index']);
Route::get('/keluhan/count-keluhan', [KeluhanController::class, 'countKeluhan']);
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
Route::get('/koperasi/saving-type/table', [JenisSimpananController::class, 'index']);
Route::post('/koperasi/saving-type/tambahdata', [JenisSimpananController::class, 'store']);
Route::put('/koperasi/saving-type/edit/{id_jenissimpanan}', [JenisSimpananController::class, 'update']);
Route::delete('/koperasi/saving-type/delete/{id_jenissimpanan}', [JenisSimpananController::class, 'destroy']);

Route::get('/koperasi/member-loan/cariAnggota', [PendaftaranAnggotaKoperasiController::class, 'cariAnggota']);
Route::get('/koperasi/member-loan/table/{id_anggota}', [PinjamanAnggotaController::class, 'show']);
Route::post('/koperasi/member-loan/loanapplication', [PinjamanAnggotaController::class, 'store']);
Route::get('/koperasi/memberdata-loan/table/{id_anggota}', [PinjamanAnggotaController::class, 'getPinjamanByAnggota']);
Route::get('/koperasi/memberdata-loan/table', [PinjamanAnggotaController::class, 'getAllPinjaman']);
Route::put('/koperasi/memberdata-loan/edit/{id_pinjaman}', [PinjamanAnggotaController::class, 'update']);
Route::delete('/koperasi/memberdata-loan/delete/{id_pinjaman}', [PinjamanAnggotaController::class, 'destroy']);

Route::get('/koperasi/memberdata-loan/data-angsuran/{id_pinjaman}', [AngsuranAnggotaController::class, 'getAngsuranByIdPinjaman']);
Route::put('/koperasi/memberdata-loan/bayar-angsuran/{id_angsuran}', [AngsuranAnggotaController::class, 'bayarAngsuran']);
Route::get('/koperasi/memberdata-loan/angsuran-total/{id_pinjaman}', [AngsuranAnggotaController::class, 'getTotalAngsuranByIdPinjaman']);
Route::get('/update-status-anggota', [PendaftaranAnggotaKoperasiController::class, 'updateStatusAnggota']);


//Konten
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery-count', [GalleryController::class, 'countGalleryData']);
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
Route::delete('/company-contact/{id}', [Cpc_company_contactController::class,  'deleteContact']);

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
Route::delete('/mitra/{id_mitra}', [Mitracontroller::class, 'deleteMitra']); // DELETE hapus mitra
Route::get('/mitra-content-count', [Mitracontroller::class, 'countMitraData']);

Route::put('/gallery/{id_galeri}', [GalleryController::class, 'updateGallery']);
Route::delete('/gallery/{id_galeri}', [GalleryController::class, 'deleteGallery']);
Route::get('/search-gallery', [GalleryController::class, 'searchGallery']);



//Help
Route::get('/help', [helpController::class, 'index']);
Route::get('/help-show/{id}', [helpController::class, 'showHelpData']);
Route::post('/add-help', [helpController::class, 'addHelp']);
Route::put('/edit-help/{id}', [helpController::class, 'updateHelp']);
Route::delete('/delete-help/{id_bantuan}', [helpController::class, 'deleteHelp']);
Route::get('/help-count', [helpController::class, 'countHelpData']);
Route::get('/search-bantuan', [helpController::class, 'searchBantuan']);



//Konten Budidaya
Route::get('/konten-bibit', [KontenBudidayaController::class, 'getDataKontenBibit']);
Route::get('/konten-bibit/{id}', [KontenBudidayaController::class, 'showDataKontenBibit']);
Route::put('/konten-bibit/{id}', [KontenBudidayaController::class, 'updateDataKontenBibit']);

Route::get('/konten-penyulingan', [KontenBudidayaController::class, 'getDataKontenPenyulingan']);
Route::get('/konten-penyulingan/{id}', [KontenBudidayaController::class, 'showDataKontenPenyulingan']);
Route::put('/konten-penyulingan/{id}', [KontenBudidayaController::class, 'updateDataKontenPenyulingan']);

Route::get('/konten-lahan', [KontenBudidayaController::class, 'getDataKontenLahan']);
Route::get('/konten-lahan/{id}', [KontenBudidayaController::class, 'showDataKontenLahan']);
Route::put('/konten-lahan/{id}', [KontenBudidayaController::class, 'updateDataKontenLahan']);

Route::get('/konten-panen', [KontenBudidayaController::class, 'getDataKontenPanen']);
Route::get('/konten-panen/{id}', [KontenBudidayaController::class, 'showDataKontenPanen']);
Route::put('/konten-panen/{id}', [KontenBudidayaController::class, 'updateDataKontenPanen']);

Route::get('/konten-perawatan', [KontenBudidayaController::class, 'getDataKontenPerawatan']);
Route::get('/konten-perawatan/{id}', [KontenBudidayaController::class, 'showDataKontenPerawatan']);
Route::put('/konten-perawatan/{id}', [KontenBudidayaController::class, 'updateDataKontenPerawatan']);

Route::get('/konten-sdm-budidaya', [KontenBudidayaController::class, 'getDataKontenSdmBudidaya']);
Route::get('/konten-sdm-budidaya/{id}', [KontenBudidayaController::class, 'showDataKontenSdmBudidaya']);
Route::put('/konten-sdm-budidaya/{id}', [KontenBudidayaController::class, 'updateDataKontenSdmBudidaya']);

Route::get('/article-content', [ContentController::class, 'index']);
Route::get('/article-content-count', [ContentController::class, 'countContentData']);
Route::get('/show-article-content/{id_konten}', [ContentController::class, 'showDataContent']);
Route::put('/edit-article-content/{id_konten}', [ContentController::class, 'updateContent']);
Route::get('/article-content/{slug}', [ContentController::class, 'detailContent']);
Route::get('/type-content', [ContentController::class, 'getContentType']);
route::post('/upload-content', [ContentController::class, 'uploadContent']);
Route::delete('/article-content/{id_konten}', [ContentController::class, 'deleteContent']);
Route::get('/search-content', [ContentController::class, 'searchContent']);



Route::get('/info-sereh-wangi', [LandingPageController::class, 'getDataInfoSerehWangi']);
Route::get('/info-sereh-wangi/{id}', [LandingPageController::class, 'showDataInfoSerehWangi']);
Route::put('/update-info-sereh-wangi/{id}', [LandingPageController::class, 'updateDataInfoSerehWangi']);
Route::get('/info-sereh-grow', [LandingPageController::class, 'getDataInfoSerehGrow']);
Route::get('/info-sereh-grow/{id}', [LandingPageController::class, 'showDataInfoSerehGrow']);
Route::put('/update-info-sereh-grow/{id}', [LandingPageController::class, 'updateDataInfoSerehGrow']);


Route::get('/testimoni', [LandingPageController::class, 'index']);
Route::get('/testimoni-count', [LandingPageController::class, 'countTestimonyData']);
Route::get('/testimoni/{id}', [LandingPageController::class, 'showDataTestimoni']);
Route::post('/testimoni', [LandingPageController::class, 'addDataTestimoni']);
Route::put('/testimoni/{id}', [LandingPageController::class, 'updateDataTestimoni']);
Route::delete('/testimoni/{id}', [LandingPageController::class, 'deleteDataTestimoni']);
Route::get('/search-testimoni', [LandingPageController::class, 'searchTestimoni']);