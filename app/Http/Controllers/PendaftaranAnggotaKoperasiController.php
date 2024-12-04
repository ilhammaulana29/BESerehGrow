<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggotakoperasi;
use Illuminate\Support\Facades\DB;
class PendaftaranAnggotaKoperasiController extends Controller
{
    public function index()
    {
        $anggota = Anggotakoperasi::all();
        return response()->json([
            'success' => true,
            'data' => $anggota,
        ], 200);
    }
    public function store(Request $request)
    {
        try {
            $anggota = Anggotakoperasi::create([
                'nama_anggota' => $request->nama_anggota,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
            ]);
    
            return response()->json(['id_anggota' => $anggota->id_anggota], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id_anggota)
    {
        try {
            $anggota = Anggotakoperasi::findOrFail($id_anggota);

            $anggota->update([
                'nama_anggota' => $request->nama_anggota,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
                'id_statusanggota' => $request->id_statusanggota,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil diperbarui',
                'data' => $anggota,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id_anggota)
    {
        try {
            $anggota = Anggotakoperasi::findOrFail($id_anggota);

            $anggota->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getByMemberId($id_anggota)
    {
        try {
            // Query ke tabel `pm` berdasarkan `id_anggota`
            $data = Anggotakoperasi::where('id_anggota', $id_anggota)->get();
    
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
    public function getNamaAnggota()
    {
        try {
            $anggotaKoperasi = Anggotakoperasi::select('id_anggota', 'nama_anggota')->get();
            return response()->json($anggotaKoperasi, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }

    public function cariAnggota(Request $request)
    {
        // Ambil parameter pencarian dari request
        $namaAnggota = $request->input('nama_anggota');
        $nik = $request->input('nik');

        // Query join tabel
        $hasil = DB::table('pc_anggota_koperasi as anggota')
            ->join('pc_status_keanggotaan as status', 'anggota.id_statusanggota', '=', 'status.id_statusanggota')
            ->select(
                
                'anggota.nama_anggota',
                'anggota.id_anggota',
                'anggota.tgl_bergabung',
                'anggota.nik',
                'anggota.no_kk',
                'anggota.no_hp',
                'anggota.tgl_lahir',
                'status.status'
            )
            // Tambahkan filter jika nama_anggota diinputkan
            ->when($namaAnggota, function ($query, $namaAnggota) {
                return $query->where('anggota.nama_anggota', 'like', '%' . $namaAnggota . '%');
            })
            // Tambahkan filter jika nik diinputkan
            ->when($nik, function ($query, $nik) {
                return $query->where('anggota.nik', $nik);
            })
            ->get();

        // Return hasil pencarian dalam bentuk JSON
        return response()->json($hasil);
    }
    public function updateStatusAnggota()
    {
        try {
            // Ambil semua data anggota
            $anggotaList = DB::table('pc_anggota_koperasi')->get();

            foreach ($anggotaList as $anggota) {
                $bulanKeanggotaan = now()->diffInMonths(new \DateTime($anggota->tgl_bergabung));

                // Cari status keanggotaan berdasarkan minimal_keanggotaan
                $status = DB::table('pc_status_keanggotaan')
                    ->where('minimal_keanggotaan', '<=', $bulanKeanggotaan)
                    ->orderBy('minimal_keanggotaan', 'desc')
                    ->first();

                if ($status && $anggota->id_statusanggota != $status->id_statusanggota) {
                    // Update id_statusanggota jika berbeda
                    DB::table('pc_anggota_koperasi')
                        ->where('id_anggota', $anggota->id_anggota)
                        ->update(['id_statusanggota' => $status->id_statusanggota]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Status anggota berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status anggota', 'error' => $e->getMessage()]);
        }
    }

}
