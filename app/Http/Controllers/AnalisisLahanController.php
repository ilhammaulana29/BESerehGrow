<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnalisisLahan;

class AnalisisLahanController extends Controller
{
     // Method untuk mengambil semua data analisis lahan
    public function index()
    {
        $data = AnalisisLahan::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'luas_lahan' => 'required|numeric',
            'kapasitas_penyulingan' => 'required|numeric',
        ]);

        // Melakukan perhitungan
        $jumlahBlok = 24; // Setiap hektar dibagi menjadi 24 blok
        $luasBlok = $validatedData['luas_lahan'] / $jumlahBlok;
        $jumlahRumpun = $luasBlok * 10000; // Jumlah rumpun per blok
        $produksiDaun = ($jumlahRumpun / 2000) * 100; // Produksi daun per blok
        $sesiPenyulingan = $produksiDaun / $validatedData['kapasitas_penyulingan'];
        $hasilPenyulingan = $validatedData['kapasitas_penyulingan'] / 80;

        // Membulatkan nilai
        $sesiPenyulingan = ceil($sesiPenyulingan);
        $hasilPenyulingan = round($hasilPenyulingan, 1);

        // Mendapatkan tanggal saat ini
        $tanggalSekarang = now();

        // Membuat kode laporan
        $tahun = $tanggalSekarang->format('Y');
        $nomorLaporan = AnalisisLahan::whereYear('tgl_buat', $tahun)->count() + 1; // Menghitung laporan di tahun yang sama
        $kodeLaporan = sprintf('SRG-%s-LP-%03d', $tahun, $nomorLaporan);
        // Simpan data ke database
        $analisis = AnalisisLahan::create([
            'luas_lahan' => $validatedData['luas_lahan'],
            'jumlah_blok' => $jumlahBlok,
            'luas_blok' => $luasBlok,
            'jumlah_rumpun' => $jumlahRumpun,
            'produksi_daun' => $produksiDaun,
            'sesi_panen' => $jumlahBlok / 2, // Contoh, sesuaikan jika perlu
            'kapasitas_penyulingan' => $validatedData['kapasitas_penyulingan'],
            'sesi_penyulingan' => $sesiPenyulingan,
            'hasil_minyak' => $hasilPenyulingan,
            'tgl_buat' => $tanggalSekarang, // Otomatis diisi dengan tanggal saat ini
            'kode_laporan' => $kodeLaporan, // Format kode laporan
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $analisis], 201);
    }

    // Method untuk menghapus data analisis lahan
    public function destroy($id_analisislahan)
    {
        $analisisLahan = AnalisisLahan::findOrFail($id_analisislahan);
        $analisisLahan->delete(); // Hapus data
        return response()->json(null, 204); // Kembalikan respons kosong
    }
}
