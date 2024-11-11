<?php

namespace App\Http\Controllers;

use App\Models\Plasma;
use Illuminate\Http\Request;

class PlasmaController extends Controller
{
    public function index()
    {
        return response()->json(Plasma::all());
    }

    public function show($id)
    {
        $plasma = Plasma::findOrFail($id);
        return response()->json($plasma);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petani' => 'required|string',
            'berat_daun' => 'required|numeric',
            'jenis_rumpun' => 'required|string',
            'total_harga' => 'required|numeric',
            'tgl_setor' => 'required|date',
        ]);

        $plasma = Plasma::create($validated);
        return response()->json($plasma, 201);
    }

    public function update(Request $request, $id)
    {
        $plasma = Plasma::findOrFail($id);

        $validated = $request->validate([
            'nama_petani' => 'required|string',
            'berat_daun' => 'required|numeric',
            'jenis_rumpun' => 'required|string',
            'total_harga' => 'required|numeric',
            'tgl_setor' => 'required|date',
        ]);

        $plasma->update($validated);
        return response()->json($plasma);
    }

    public function destroy($id)
    {
        $plasma = Plasma::findOrFail($id);
        $plasma->delete();

        return response()->json(['message' => 'Plasma record deleted successfully']);
    }
}
