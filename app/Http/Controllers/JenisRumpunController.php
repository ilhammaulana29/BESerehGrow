<?php

namespace App\Http\Controllers;

use App\Models\JenisRumpun;
use Illuminate\Http\Request;

class JenisRumpunController extends Controller
{
    public function index()
    {
        return response()->json(JenisRumpun::all());
    }

    public function store(Request $request)
    {
        $request->validate(['jenis_rumpun' => 'required|unique:jenis_rumpun,jenis_rumpun']);

        $jenisRumpun = JenisRumpun::create($request->all());
        return response()->json($jenisRumpun, 201);
    }

    public function show($id)
    {
        $jenisRumpun = JenisRumpun::find($id);

        if (!$jenisRumpun) {
            return response()->json(['message' => 'Jenis Rumpun not found'], 404);
        }

        return response()->json($jenisRumpun);
    }

    public function update(Request $request, $id)
    {
        $jenisRumpun = JenisRumpun::find($id);

        if (!$jenisRumpun) {
            return response()->json(['message' => 'Jenis Rumpun not found'], 404);
        }

        $request->validate(['jenis_rumpun' => 'required|unique:jenis_rumpun,jenis_rumpun,' . $id]);

        $jenisRumpun->update($request->all());
        return response()->json($jenisRumpun);
    }

    public function destroy($id)
    {
        $jenisRumpun = JenisRumpun::find($id);

        if (!$jenisRumpun) {
            return response()->json(['message' => 'Jenis Rumpun not found'], 404);
        }

        $jenisRumpun->delete();
        return response()->json(['message' => 'Jenis Rumpun deleted successfully']);
    }
}
