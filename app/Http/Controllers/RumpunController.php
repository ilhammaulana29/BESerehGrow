<?php

namespace App\Http\Controllers;

use App\Models\Rumpun;
use Illuminate\Http\Request;

class RumpunController extends Controller
{
    public function index()
    {
        return Rumpun::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'nama_blok' => 'required|string',
            'jenis_rumpun' => 'required|string',
            'lebar_rumpun' => 'required|numeric',
            'tinggi_rumpun' => 'required|numeric',
            'warna_daun' => 'required|string',
            'lebar_daun' => 'required|numeric',
            'tekstur_daun' => 'required|string',
        ]);

        $rumpun = Rumpun::create($validated);
        return response()->json($rumpun, 201);
    }

    public function show($id)
    {
        return Rumpun::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_blok' => 'sometimes|exists:cm_bloklahan,id_bloklahan',
            'nama_blok' => 'required|string',
            'jenis_rumpun' => 'required|string',
            'lebar_rumpun' => 'required|numeric',
            'tinggi_rumpun' => 'required|numeric',
            'warna_daun' => 'required|string',
            'lebar_daun' => 'required|numeric',
            'tekstur_daun' => 'required|string',
        ]);

        $rumpun = Rumpun::findOrFail($id);
        $rumpun->update($validated);
        return response()->json($rumpun, 200);
    }

    public function destroy($id)
    {
        $rumpun = Rumpun::findOrFail($id);
        $rumpun->delete();
        return response()->json(null, 204);
    }
}
