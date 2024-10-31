<?php

namespace App\Http\Controllers;

use App\Models\Pemupukan;
use Illuminate\Http\Request;

class PemupukanController extends Controller
{
    public function index()
    {
        return Pemupukan::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'tgl_pemupukan' => 'required|date',
            'jumlah_pupuk' => 'required|numeric',
            'jenis_pupuk' => 'required|string'
        ]);

        return Pemupukan::create($data);
    }

    public function show($id)
    {
        return Pemupukan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_blok' => 'sometimes|exists:cm_bloklahan,id_bloklahan',
            'tgl_pemupukan' => 'sometimes|date',
            'jumlah_pupuk' => 'sometimes|numeric',
            'jenis_pupuk' => 'sometimes|string'
        ]);

        $pemupukan = Pemupukan::findOrFail($id);
        $pemupukan->update($data);

        return $pemupukan;
    }

    public function destroy($id)
    {
        $pemupukan = Pemupukan::findOrFail($id);
        $pemupukan->delete();

        return response()->json(['message' => 'Pemupukan deleted successfully']);
    }
}
