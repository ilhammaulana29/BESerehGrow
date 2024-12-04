<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalkulasilahan;
use App\Models\Parameterkalkulasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class AnalisisLahanController extends Controller
{
     // Method untuk mengambil semua data analisis lahan
    public function index()
    {
        $data = Kalkulasilahan::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'luas_lahan' => 'required|numeric|min:0',
            'kapasitas_penyulingan' => 'required|numeric|min:1', // Minimal 1 untuk mencegah nol
        ]);

        $parameter = Parameterkalkulasi::orderBy('created_at', 'desc')->first();
        if (!$parameter) {
            Log::error('Parameter kalkulasi tidak ditemukan');
            return response()->json(['error' => 'Parameter kalkulasi tidak ditemukan'], 404);
        }

        if ($parameter->jumlah_blok == 0) {
            Log::error('Jumlah blok pada parameter tidak boleh nol');
            return response()->json(['error' => 'Jumlah blok pada parameter tidak boleh nol'], 400);
        }

        // Input user
        $luas_lahan = $request->luas_lahan;
        $kapasitas_penyulingan = $request->kapasitas_penyulingan;

        // Perhitungan
        $luas_per_blok = $luas_lahan / $parameter->jumlah_blok;
        $jumlah_rumpun_per_blok = round(($luas_per_blok * 10000) / $parameter->jarak_tanam);
        $sesi_panen_per_minggu = $parameter->sesi_panen_per_minggu;
        $produksi_daun_per_minggu =round($jumlah_rumpun_per_blok * 1.8);
        $produksi_daun_per_hari =round($produksi_daun_per_minggu / $sesi_panen_per_minggu);
        $produksi_minyak_per_minggu = round($produksi_daun_per_minggu / 142);
        $hasil_minyak = round($produksi_minyak_per_minggu / 6);

        $sesi_penyulingan_minggu = round($produksi_daun_per_minggu / $kapasitas_penyulingan);

        $pendapatan_bawah_30 = $parameter->harga_minyak_bawah_30 * $produksi_minyak_per_minggu;
        $pendapatan_atas_30 = $parameter->harga_minyak_atas_30 * $produksi_minyak_per_minggu;

        // Simpan ke database
        $kalkulasi = new KalkulasiLahan();
        $kalkulasi->id_parameter = $parameter->id_parameter;
        $kalkulasi->kode_laporan_analisis = 'SRG-LA' . time(); // Generate kode laporan unik
        $kalkulasi->tgl_buat = now();
        $kalkulasi->luas_lahan = $luas_lahan;
        $kalkulasi->kapasitas_penyulingan = $kapasitas_penyulingan;
        $kalkulasi->luas_per_blok = $luas_per_blok;
        $kalkulasi->jumlah_rumpun_per_blok = $jumlah_rumpun_per_blok;
        $kalkulasi->produksi_daun_per_minggu = $produksi_daun_per_minggu;
        $kalkulasi->produksi_daun_per_hari = $produksi_daun_per_hari;
        $kalkulasi->sesi_penyulingan_minggu = $sesi_penyulingan_minggu;
        $kalkulasi->produksi_minyak_per_minggu = $produksi_minyak_per_minggu;
        $kalkulasi->hasil_minyak = $hasil_minyak;
        $kalkulasi->pendapatan_bawah_30 = $pendapatan_bawah_30;
        $kalkulasi->pendapatan_atas_30 = $pendapatan_atas_30;

        $kalkulasi->save();

        // Response sukses
        return response()->json([
            'message' => 'Kalkulasi lahan berhasil disimpan',
            'data' => $kalkulasi->only([
                'kode_laporan_analisis',
                'tgl_buat',
                'luas_lahan',
                'kapasitas_penyulingan',
                'luas_per_blok',
                'jumlah_rumpun_per_blok',
                'sesi_penyulingan_minggu',
                'produksi_daun_per_minggu',
                'produksi_daun_per_hari',
                'hasil_minyak',
                'produksi_minyak_per_minggu',
                'pendapatan_bawah_30',
                'pendapatan_atas_30',
            ])
        ]);
        
    }


    // Method untuk menghapus data analisis lahan
    public function destroy($id_analisislahan)
    {
        $analisisLahan = Kalkulasilahan::findOrFail($id_analisislahan);
        $analisisLahan->delete(); // Hapus data
        return response()->json(null, 204); // Kembalikan respons kosong
    }
    public function countAnalisislahan()
    {
        try {
            // Hitung jumlah data Analisislahan yang ada
            $count = Kalkulasilahan::count();

            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => 'Jumlah data Analisislahan berhasil dihitung'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam menghitung jumlah data Analisislahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getJoinedData()
    {
        $data = DB::table('la_kalkulasi_lahan')
        ->join('la_parameter_kalkulasi', 'la_kalkulasi_lahan.id_parameter', '=', 'la_parameter_kalkulasi.id_parameter')
        ->select(
            'la_kalkulasi_lahan.*', 
            'la_parameter_kalkulasi.jumlah_blok', 
            'la_parameter_kalkulasi.jarak_tanam', 
            'la_parameter_kalkulasi.sesi_panen_per_minggu', 
            'la_parameter_kalkulasi.harga_minyak_bawah_30', 
            'la_parameter_kalkulasi.harga_minyak_atas_30',
            'la_kalkulasi_lahan.kode_laporan_analisis',
            'la_kalkulasi_lahan.tgl_buat',
            'la_kalkulasi_lahan.luas_lahan',
            'la_kalkulasi_lahan.kapasitas_penyulingan',
            'la_kalkulasi_lahan.luas_per_blok',
            'la_kalkulasi_lahan.jumlah_rumpun_per_blok',
            'la_kalkulasi_lahan.sesi_penyulingan_minggu',
            'la_kalkulasi_lahan.produksi_daun_per_minggu',
            'la_kalkulasi_lahan.produksi_daun_per_hari',
            'la_kalkulasi_lahan.hasil_minyak',
            'la_kalkulasi_lahan.produksi_minyak_per_minggu',
            'la_kalkulasi_lahan.pendapatan_bawah_30',
            'la_kalkulasi_lahan.pendapatan_atas_30',
        )
        ->get();

        return response()->json([
            'message' => 'Semua data berhasil diambil',
            'data' => $data
        ]);
    }
    public function latestProduksiDaunData()
    {
        $data = Kalkulasilahan::select('luas_lahan', 'produksi_daun_per_minggu')
        ->orderBy('luas_lahan', 'desc') // Urutkan berdasarkan tanggal produksi daun terbaru
        ->take(5) // Ambil hanya 5 data terbaru
        ->get()
        ->sortBy('luas_lahan')
        ->values();
        

        Log::info('Data produksi daun (5 terbaru, diurutkan):', $data->toArray());

        return response()->json([
            'message' => 'Data grafik produksi daun berhasil diambil',
            'data' => $data,
        ]);
    }
}
