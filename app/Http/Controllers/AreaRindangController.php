<?php

namespace App\Http\Controllers;

use App\Models\CmAreaRindang;
use Illuminate\Http\Request;

class AreaRindangController extends Controller
{
    public function index()
    {
        $areas = CmAreaRindang::with('bloklahan')->get();
        return response()->json($areas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
            'jumlah_rumpun' => 'required|integer',
            'luas' => 'required|numeric',
        ]);

        $area = CmAreaRindang::create($validatedData);
        return response()->json($area, 201);
    }

    public function show($id)
    {
        $area = CmAreaRindang::with('bloklahan')->findOrFail($id);
        return response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $area = CmAreaRindang::findOrFail($id);

        $validatedData = $request->validate([
            'id_blok' => 'sometimes|exists:cm_bloklahan,id_bloklahan',
            'jumlah_rumpun' => 'sometimes|integer',
            'luas' => 'sometimes|numeric',
        ]);

        $area->update($validatedData);
        return response()->json($area);
    }

    public function destroy($id)
    {
        $area = CmAreaRindang::findOrFail($id);
        $area->delete();

        return response()->json(null, 204);
    }
}
