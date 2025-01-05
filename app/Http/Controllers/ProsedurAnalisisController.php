<?php

namespace App\Http\Controllers;

use App\Models\ProsedurAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Facades\Log; 

class ProsedurAnalisisController extends Controller
{
    public function index()
    {
        $data = ProsedurAnalisis::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function getByJenisKonten($jenis_konten)
    {
        $data = ProsedurAnalisis::where('jenis_konten', $jenis_konten)->get();
        return response()->json($data);
    }
    // Contoh pada ProsedurController.php
    public function show($id)
    {
        try {
            // Temukan prosedur berdasarkan ID
            $prosedur = ProsedurAnalisis::findOrFail($id);

            // Kirim data ke frontend dalam format JSON
            return response()->json([
                'success' => true,
                'data' => $prosedur
            ]);
        } catch (\Exception $e) {
            // Penanganan jika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Prosedur tidak ditemukan.'
            ], 404);
        }
    }


    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'jenis_konten' => 'required|string',
            'judul' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable', // Validasi file gambar
            'deskripsi' => 'required|string',
        ]);

        try {
            // Upload gambar dan simpan di storage
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                
                // Menggunakan nama asli file dengan menambahkan timestamp untuk mencegah duplikasi
                $gambarName = time() . '_' . $file->getClientOriginalName(); // Contoh: 1698246145_image.jpg

                // Simpan file di disk public
                $path = $file->storeAs('image-procedure', $gambarName, 'public'); // Simpan di storage/app/public/gambar
            }
            

            // Simpan data ke database
            $prosedur = ProsedurAnalisis::create([
                'jenis_konten' => $request->jenis_konten,
                'judul' => $request->judul,
                'gambar' => $gambarName, // Simpan nama file gambar ke database
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'message' => 'Prosedur berhasil disimpan',
                'data' => $prosedur
            ], 201); // Status HTTP 201 Created

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan prosedur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateData(Request $request, $id)
    {
        $prosedur = ProsedurAnalisis::findOrFail($id);
        Log::info('Data ditemukan:', $prosedur->toArray());

        $validatedData = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'string|nullable',
        ]);

        Log::info('Data yang divalidasi:', $validatedData);

        $prosedur->jenis_konten = $validatedData['jenis_konten'] ?? $prosedur->jenis_konten;
        $prosedur->judul = $validatedData['judul'];
        $prosedur->deskripsi = $validatedData['deskripsi'] ?? $prosedur->deskripsi;

        $saved = $prosedur->save();
        Log::info('Status penyimpanan data teks:', ['saved' => $saved]);

        if (!$saved) {
            return response()->json(['message' => 'Failed to update text data.'], 500);
        }

        return response()->json(['message' => 'Text data updated successfully.']);
    }
    public function updateGambar(Request $request, $id)
    {
        $prosedur = ProsedurAnalisis::findOrFail($id);
        Log::info('Data ditemukan untuk update gambar:', $prosedur->toArray());

        $validatedData = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Data gambar yang divalidasi:', $validatedData);

        if ($request->hasFile('gambar')) {
            if ($prosedur->gambar) {
                Storage::disk('public')->delete($prosedur->gambar);
            }
            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('image-procedure', $gambarName, 'public');
            $prosedur->gambar = $gambarName;
        }

        $saved = $prosedur->save();
        Log::info('Status penyimpanan gambar:', ['saved' => $saved]);

        if (!$saved) {
            return response()->json(['message' => 'Failed to update image.'], 500);
        }

        return response()->json(['message' => 'Image updated successfully.']);
    }


    public function destroy($id)
    {
        try {
            // Temukan prosedur berdasarkan ID
            $prosedur = ProsedurAnalisis::findOrFail($id);

            // Jika ada file gambar terkait, hapus dari storage
            if ($prosedur->gambar) {
                Storage::disk('public')->delete('image-procedure/' . $prosedur->gambar);
            }

            // Hapus data dari database
            $prosedur->delete();

            return response()->json([
                'message' => 'Prosedur berhasil dihapus.'
            ], 200);

        } catch (\Exception $e) {
            // Jika ada kesalahan atau data tidak ditemukan
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus prosedur atau prosedur tidak ditemukan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurLahan()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Prosedur Lahan')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Prosedur Lahan berhasil diambil',
                'data' => [
                    'Prosedur Lahan' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Prosedur Lahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurPenanaman()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Prosedur Penanaman')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Prosedur Penanaman berhasil diambil',
                'data' => [
                    'Prosedur Penanaman' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Prosedur Penanaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurPerawatan()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Prosedur Perawatan')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Prosedur Perawatan berhasil diambil',
                'data' => [
                    'Prosedur Perawatan' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Prosedur Perawatan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurPanen()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Prosedur Panen')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Prosedur Panen berhasil diambil',
                'data' => [
                    'Prosedur Panen' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Prosedur Panen',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurPenyulingan()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Prosedur Penyulingan')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Prosedur Penyulingan berhasil diambil',
                'data' => [
                    'Prosedur Penyulingan' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Prosedur Penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByJenisProsedurAlatPenyulingan()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = ProsedurAnalisis::where('jenis_konten', 'Alat Penyulingan')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Alat Penyulingan berhasil diambil',
                'data' => [
                    'Alat Penyulingan' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Alat Penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
