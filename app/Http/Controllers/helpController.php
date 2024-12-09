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
            'jawaban' => 'required|max:100'
        ]);

        // Menyimpan ke database
        $help = new Help();
        $help->pertanyaan = $request->pertanyaan;
        $help->jawaban = $request->jawaban;
        $help->save();

        return response()->json([
            'message' => 'Bantuan berhasil ditambah',
            'help' => $help,
        ], 201);
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
            'jawaban' => 'required|max:100'
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
    public function deleteHelp($id)
    {
        // Mencari data bantuan berdasarkan ID
        $help = Help::find($id);
        if (!$help) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Menghapus data
        $help->delete();

        return response()->json(['message' => 'Bantuan berhasil dihapus']);

   }
}