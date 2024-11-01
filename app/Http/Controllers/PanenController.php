<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    public function index()
    {
        return response()->json(Panen::all());
    }

    public function show($id)
    {
        $panen = Panen::findOrFail($id);
        return response()->json($panen);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'nama_blok' => 'required|string',
            'tgl_panen' => 'required|date',
            'berat_daun' => 'required|numeric',
            'jumlah_ikat' => 'required|numeric',
            'total_berat_daun' => 'required|numeric',
        ]);

        $panen = Panen::create($validated);
        return response()->json($panen, 201);
    }

    public function update(Request $request, $id)
    {
        $panen = Panen::findOrFail($id);

        $validated = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'nama_blok' => 'required|string',
            'tgl_panen' => 'required|date',
            'berat_daun' => 'required|numeric',
            'jumlah_ikat' => 'required|numeric',
            'total_berat_daun' => 'required|numeric',
        ]);

        $panen->update($validated);
        return response()->json($panen);
    }

    public function destroy($id)
    {
        $panen = Panen::findOrFail($id);
        $panen->delete();

        return response()->json(['message' => 'Panen record deleted successfully']);
    }
}
