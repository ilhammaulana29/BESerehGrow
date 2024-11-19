<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\JenisSimpanan;
use Illuminate\Support\Facades\DB;

class SimpananAnggotaKoperasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
            'id_jenissimpanan' => 'required|exists:pc_jenis_simpanan,id_jenissimpanan',
            'tgl_simpan' => 'required|date',
            'jml_simpanan' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Buat data simpanan
        $simpanan = Simpanan::create([
            'id_anggota' => $validated['id_anggota'],
            'id_jenissimpanan' => $validated['id_jenissimpanan'],
            'tgl_simpan' => $validated['tgl_simpan'],
            'jml_simpanan' => $validated['jml_simpanan'],
            'keterangan' => $validated['keterangan'] ?? null, // Jika null, simpan sebagai null
        ]);

        // Response berhasil
        return response()->json([
            'message' => 'Simpanan berhasil disimpan',
            'data' => $simpanan,
        ], 201);
    }

    public function getMemberSavingData(Request $request, $id_anggota)
    {
        // Ambil nilai filter nama_simpanan dari query string jika ada
        $filterNamaSimpanan = $request->input('nama_simpanan');
    
        // Query join antara pc_simpanan dan pc_jenis_simpanan berdasarkan id_anggota
        $query = Simpanan::join('pc_jenis_simpanan', 'pc_simpanan.id_jenissimpanan', '=', 'pc_jenis_simpanan.id_jenissimpanan')
                        ->where('pc_simpanan.id_anggota', $id_anggota)
                        ->select('pc_jenis_simpanan.nama_simpanan', 'pc_simpanan.tgl_simpan', 'pc_simpanan.jml_simpanan', 'pc_simpanan.keterangan');
    
        // Jika ada filter nama_simpanan, tambahkan kondisi where untuk menyaring data
        if ($filterNamaSimpanan) {
            $query->where('pc_jenis_simpanan.nama_simpanan', $filterNamaSimpanan);
        }
    
        // Ambil data berdasarkan query yang sudah difilter
        $data = $query->get();
    
        return response()->json($data);
    }
    public function getAllSavingsData()
    {
        // Query join antara tabel-tabel yang dibutuhkan
        $data = DB::table('pc_simpanan')
            ->join('pc_anggota_koperasi', 'pc_simpanan.id_anggota', '=', 'pc_anggota_koperasi.id_anggota')
            ->join('pc_status_keanggotaan', 'pc_anggota_koperasi.id_statusanggota', '=', 'pc_status_keanggotaan.id_statusanggota')

            ->join('pc_jenis_simpanan', 'pc_simpanan.id_jenissimpanan', '=', 'pc_jenis_simpanan.id_jenissimpanan')
            ->select(
                'pc_anggota_koperasi.nama_anggota',
                'pc_status_keanggotaan.status',
                'pc_jenis_simpanan.nama_simpanan',
                'pc_simpanan.tgl_simpan',
                'pc_simpanan.jml_simpanan',
                'pc_simpanan.keterangan'
            )
             // Mengurutkan berdasarkan tanggal simpan terbaru
            ->get();

        return response()->json($data);
    }
    public function getFilteredSavingsData(Request $request)
    {
        $filterStatus = $request->input('status');
        $filterNamaSimpanan = $request->input('nama_simpanan');

        $query = DB::table('pc_simpanan')
            ->join('pc_anggota_koperasi', 'pc_simpanan.id_anggota', '=', 'pc_anggota_koperasi.id_anggota')
            ->join('pc_status_keanggotaan', 'pc_anggota_koperasi.id_statusanggota', '=', 'pc_status_keanggotaan.id')
            ->join('pc_jenis_simpanan', 'pc_simpanan.id_jenissimpanan', '=', 'pc_jenis_simpanan.id_jenissimpanan')
            ->select(
                'pc_anggota_koperasi.nama_anggota',
                'pc_status_keanggotaan.status',
                'pc_jenis_simpanan.nama_simpanan',
                'pc_simpanan.tgl_simpan',
                'pc_simpanan.jml_simpanan',
                'pc_simpanan.keterangan'
            );

        if ($filterStatus) {
            $query->where('pc_status_keanggotaan.status', $filterStatus);
        }

        if ($filterNamaSimpanan) {
            $query->where('pc_jenis_simpanan.nama_simpanan', $filterNamaSimpanan);
        }

        $data = $query->get();

        return response()->json($data);
    }

}
