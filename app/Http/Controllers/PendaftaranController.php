<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alamatanggota;
use App\Models\Simpanan;
use App\Models\Anggotakoperasi;

class PendaftaranController extends Controller
{
    public function store(Request $request)
{
    // Validasi Data
    $validatedData = $request->validate([
        // Data Anggota
        'nama_anggota' => 'required|string|max:255',
        'tgl_bergabung' => 'required|date',
        'nik' => 'required|string|max:16',
        'no_kk' => 'required|string|max:16',
        'no_hp' => 'required|string|max:15',
        'tgl_lahir' => 'required|date',
        'id_statusanggota' => 'required|exists:pc_status_keanggotaan,id_statusanggota',
        
        // Data Alamat
        'jalan' => 'required|string|max:255',
        'desa' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kabupaten' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kode_pos' => 'required|string|max:10',
        'no_rumah' => 'nullable|string|max:10',
        'rt' => 'nullable|string|max:5',
        'rw' => 'nullable|string|max:5',
        // Data Simpanan
        'id_jenissimpanan' => 'required|exists:pc_jenis_simpanan,id_jenissimpanan',
        'tgl_simpan' => 'required|date',
        'jml_simpanan' => 'required|numeric',
        'keterangan' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        // 1. Simpan Data Anggota
        $anggota = new Anggotakoperasi(); // Model Anggota
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->tgl_bergabung = $request->tgl_bergabung;
        $anggota->nik = $request->nik;
        $anggota->no_kk = $request->no_kk;
        $anggota->no_hp = $request->no_hp;
        $anggota->tgl_lahir = $request->tgl_lahir;
        $anggota->id_statusanggota = $request->id_statusanggota;
        $anggota->save();

        $id_anggota = $anggota->id_anggota; // Ambil ID anggota yang baru disimpan

        // 2. Simpan Data Alamat
        $alamat = new AlamatAnggota(); // Model Alamat
        $alamat->id_anggota = $id_anggota;
        $alamat->jalan = $request->jalan;
        $alamat->desa = $request->desa;
        $alamat->kecamatan = $request->kecamatan;
        $alamat->kabupaten = $request->kabupaten;
        $alamat->provinsi = $request->provinsi;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->no_rumah = $request->no_rumah;
        $alamat->rt = $request->rt;
        $alamat->rw = $request->rw;
        $alamat->save();

        // 3. Simpan Data Simpanan
        $simpanan = new Simpanan(); // Model Simpanan
        $simpanan->id_anggota = $id_anggota;
        $simpanan->id_jenissimpanan = $request->id_jenissimpanan;
        $simpanan->tgl_simpan = $request->tgl_simpan;
        $simpanan->jml_simpanan = $request->jml_simpanan;
        $simpanan->keterangan = $request->keterangan;
        $simpanan->save();

        DB::commit();

        // Berhasil
        return response()->json([
            'message' => 'Data anggota, alamat, dan simpanan berhasil disimpan.',
            'id_anggota' => $id_anggota,
        ], 201);
    } catch (\Exception $e) {
        // Rollback jika ada error
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
}
