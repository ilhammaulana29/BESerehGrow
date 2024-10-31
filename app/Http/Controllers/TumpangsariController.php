<?php

namespace App\Http\Controllers;

use App\Models\Tumpangsari;
use Illuminate\Http\Request;

class TumpangsariController extends Controller
{
    public function index()
    {
        return Tumpangsari::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'jenis_tanaman' => 'required|string',
            'jumlah_tanaman' => 'required|integer',
            'tinggi_tanaman' => 'required|numeric'
        ]);

        return Tumpangsari::create($data);
    }

    public function show($id)
    {
        return Tumpangsari::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_blok' => 'sometimes|exists:cm_bloklahan,id_bloklahan',
            'jenis_tanaman' => 'sometimes|string',
            'jumlah_tanaman' => 'sometimes|integer',
            'tinggi_tanaman' => 'sometimes|numeric'
        ]);

        $tumpangsari = Tumpangsari::findOrFail($id);
        $tumpangsari->update($data);

        return $tumpangsari;
    }

    public function destroy($id)
    {
        $tumpangsari = Tumpangsari::findOrFail($id);
        $tumpangsari->delete();

        return response()->json(['message' => 'Tumpangsari deleted successfully']);
    }
}
