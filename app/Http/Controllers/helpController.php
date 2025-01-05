<?php

namespace App\Http\Controllers;

use App\Models\Help;
use Illuminate\Http\Request;

class helpController extends Controller
{
    // Menampilkan semua data bantuan
    public function index()
    {
        $helps = Help::all();
        return response()->json($helps);
    }

    // Menambahkan data bantuan baru
    public function addHelp(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        // Menyimpan ke database
        $help = new Help();
        $help->pertanyaan = $request->pertanyaan;
        $help->jawaban = $request->jawaban;
        $help->save();

        return response()->json([
            'message' => 'Data berhasil ditambah',
            'help' => $help,
        ], 201);
    }


    public function showHelpData($id)
    {
        $data = Help::findOrFail($id);
        return response()->json($data);
    }


    public function countHelpData()
    {
        $help = Help::count();

        return response()->json([
            'data' => [
                'count' => $help
            ]
            ]);

    }

    // Mengupdate data bantuan
    public function updateHelp(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        // Mencari data bantuan berdasarkan ID
        $help = Help::find($id);
        if (!$help) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Mengupdate data
        $help->pertanyaan = $request->pertanyaan;
        $help->jawaban = $request->jawaban;
        $help->save();

        return response()->json([
            'message' => 'Bantuan berhasil diperbarui',
            'help' => $help,
        ]);
    }

    // Menghapus data bantuan
    public function deleteHelp($id_bantuan)
    {
        // Mencari data bantuan berdasarkan ID
        $help = Help::find($id_bantuan);
        if (!$help) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Menghapus data
        $help->delete();

        return response()->json(['message' => 'Bantuan berhasil dihapus']);

   }


   public function searchBantuan(Request $request)
   {
       $query = $request->input('query');
       
       if (!$query) {
           return response()->json([], 200); // Jika kosong, kembalikan array kosong
       }

       // Sesuaikan pencarian dengan kebutuhan Anda
       $results = Help::where('pertanyaan', 'LIKE', "%$query%")
                           ->orWhere('jawaban', 'LIKE', "%$query%")
                           ->get();

       return response()->json($results, 200);
   }
}
