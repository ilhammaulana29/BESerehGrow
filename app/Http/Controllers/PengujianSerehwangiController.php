<?php

namespace App\Http\Controllers;

use App\Models\Hasilpemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Pengujian;

class PengujianSerehwangiController extends Controller
{
    public function index()
    {
        $data = Pengujian::all(); // Ambil semua data tanpa pengurutan
        return response()->json($data); // Kembalikan data sebagai JSON
    }

    public function store(Request $request)
    {
        // Validasi input
        
        $validator = Validator::make($request->all(), [
            'id_penyulingan' => 'required|numeric',
            'tgl_diterima' => 'required|date',
            'kemasan' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'kode_bahan' => 'required|string',
            'sertifikasi' => 'required|string',
            'tgl_pemeriksaan' => 'required|date',

            'warna' => 'required|string',
            'bau' => 'required|string',
            'kelarutan_ethanol' => 'required|string',
            'lemak' => 'required|string',
            'indeks_bias'=> 'required|numeric',
            'berat_jenis' => 'required|string',
            'putaran_optik'=> 'required|numeric',
            'kadar_sitronelal'=> 'required|numeric',
        ]);

        DB::beginTransaction();

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buat instance baru dari model Pengujian
            $pengujian = new Pengujian();
            $pengujian->id_penyulingan = $request->id_penyulingan;
            $pengujian->tgl_diterima = $request->tgl_diterima;
            $pengujian->kemasan = $request->kemasan;
            $pengujian->jumlah = $request->jumlah;
            $pengujian->kode_bahan = $request->kode_bahan;
            $pengujian->sertifikasi = $request->sertifikasi;
            $pengujian->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pengujian->save();

            $id_pengujian = $pengujian->id_pengujian;

            $hasilpemeriksaan = new Hasilpemeriksaan();
            $hasilpemeriksaan->id_pengujian = $id_pengujian;
            $hasilpemeriksaan->warna = $request->warna;
            $hasilpemeriksaan->bau = $request->bau;
            $hasilpemeriksaan->kelarutan_ethanol = $request->kelarutan_ethanol;
            $hasilpemeriksaan->lemak = $request->lemak;
            $hasilpemeriksaan->indeks_bias = $request->indeks_bias;
            $hasilpemeriksaan->berat_jenis = $request->berat_jenis;
            $hasilpemeriksaan->putaran_optik = $request->putaran_optik;
            $hasilpemeriksaan->kadar_sitronelal = $request->kadar_sitronelal;
            $hasilpemeriksaan->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil disimpan',
                'id_pengujian' => $id_pengujian,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id_pengujian)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_penyulingan' => 'required|numeric',
            'tgl_diterima' => 'required|date',
            'kemasan' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'kode_bahan' => 'required|string',
            'sertifikasi' => 'required|string',
            'tgl_pemeriksaan' => 'required|date',
        ]);

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Cari data pengujian berdasarkan ID
            $pengujian = Pengujian::findOrFail($id_pengujian);
            
            // Update data
            $pengujian->id_penyulingan = $request->id_penyulingan;
            $pengujian->tgl_diterima = $request->tgl_diterima;
            $pengujian->kemasan = $request->kemasan;
            $pengujian->jumlah = $request->jumlah;
            $pengujian->kode_bahan = $request->kode_bahan;
            $pengujian->sertifikasi = $request->sertifikasi;
            $pengujian->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pengujian->save();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil diperbarui',
                'data' => $pengujian
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id_pengujian)
    {
        try {
            // Cari data pengujian berdasarkan id_pengujian
            $pengujian = Pengujian::findOrFail($id_pengujian);
            
            // Hapus data
            $pengujian->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penghapusan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getByPengujianId($id_pengujian)
    {
        try {
            // Query ke tabel `pm` berdasarkan `$id_pengujian`
            $data = Pengujian::where('id_pengujian', $id_pengujian)->get();
    
            // Jika ada data tambahan terkait, tambahkan di sini
            $additionalData = [
                // Masukkan data tambahan yang dibutuhkan, misalnya metadata Member
            ];
    
            return response()->json([
                'data' => $data,
                'additionalData' => $additionalData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getPengujianByPenyulinganId($id_penyulingan)
    {
        try {
            // Query ke tabel `pm` berdasarkan `$id_penyulingan`
            $data = Pengujian::where('id_penyulingan', $id_penyulingan)->get();
    
            // Jika ada data tambahan terkait, tambahkan di sini
            $additionalData = [
                // Masukkan data tambahan yang dibutuhkan, misalnya metadata Member
            ];
    
            return response()->json([
                'data' => $data,
                'additionalData' => $additionalData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getAllKodeBahan()
    {
        try {
            // Mengambil semua data dari tabel `Pengujian`
            $data = Pengujian::all(['id_pengujian', 'kode_bahan']);
            
            // Tambahkan data tambahan jika diperlukan
            $additionalData = [
                // Masukkan data tambahan jika ada
            ];

            return response()->json([
                'data' => $data,
                'additionalData' => $additionalData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countPengujian()
    {
        try {
            // Hitung jumlah data pengujian yang ada
            $count = Pengujian::count();

            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => 'Jumlah data pengujian berhasil dihitung'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam menghitung jumlah data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function searchPengujian(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return response()->json([], 200); // Jika kosong, kembalikan array kosong
        }

        // Sesuaikan pencarian dengan kebutuhan Anda
        $results = Pengujian::where('tgl_diterima', 'LIKE', "%$query%")
                            ->orWhere('jumlah', 'LIKE', "%$query%")
                            ->orWhere('kemasan', 'LIKE', "%$query%")
                            ->orWhere('kode_bahan', 'LIKE', "%$query%")
                            ->orWhere('sertifikasi', 'LIKE', "%$query%")
                            ->orWhere('tgl_pemeriksaan', 'LIKE', "%$query%")
                            ->get();

        return response()->json($results, 200);
    }
    public function sortPengujian(Request $request)
    {
        // Ambil parameter untuk pengurutan dari request frontend
        $orderBy = $request->input('orderBy', 'tgl_diterima'); // Kolom yang ingin diurutkan (default: tgl_diterima)
        $direction = $request->input('direction', 'asc'); // Arah pengurutan (default: asc)

        // Validasi kolom yang boleh digunakan untuk pengurutan
        $allowedColumns = [
            'tgl_diterima',
            'kode_bahan',
        ];

        // Validasi apakah kolom dan arah pengurutan valid
        if (!in_array($orderBy, $allowedColumns)) {
            return response()->json([
                'message' => 'Invalid order by column.'
            ], 400);
        }

        if (!in_array(strtolower($direction), ['asc', 'desc'])) {
            return response()->json([
                'message' => 'Invalid sorting direction.'
            ], 400);
        }

        // Query tanpa filter status, hanya pengurutan
        $results = Pengujian::orderBy($orderBy, $direction)->get();

        // Kembalikan data sebagai respons JSON
        return response()->json([
            'success' => true,
            'data' => $results,
            'message' => 'Data sorted successfully.',
        ], 200);
    }


}
