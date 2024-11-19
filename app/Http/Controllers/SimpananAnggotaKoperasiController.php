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
        // Validasi input (jika belum dilakukan di controller utama)
        $validated = $request->validate([
            'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
            'id_jenissimpanan' => 'required|exists:pc_jenis_simpanan,id_jenissimpanan',
            'tgl_simpan' => 'required|date',
            'jml_simpanan' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Simpan data ke tabel pc_simpanan
        $simpanan = DB::table('pc_simpanan')->insert([
            'id_anggota' => $validated['id_anggota'],
            'id_jenissimpanan' => $validated['id_jenissimpanan'],
            'tgl_simpan' => $validated['tgl_simpan'],
            'jml_simpanan' => $validated['jml_simpanan'],
            'keterangan' => $validated['keterangan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Simpanan berhasil disimpan'], 201);
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
    

}
