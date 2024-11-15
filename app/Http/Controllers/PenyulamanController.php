<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyulaman;

class PenyulamanController extends Controller
{
    // Get all records (index)
    public function index()
    {
        $penyulaman = Penyulaman::all();
        return response()->json($penyulaman, 200);
    }

    // Store a new record
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_blok' => 'required',
            'tgl_penyulaman' => 'required|date',
            'jml_rumpun' => 'required|integer',
        ]);

        $penyulaman = Penyulaman::create($validatedData);
        return response()->json($penyulaman, 201);
    }

    // Update an existing record
    public function update(Request $request, $id)
    {
        $penyulaman = Penyulaman::find($id);

        if (!$penyulaman) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validatedData = $request->validate([
            'id_blok' => 'sometimes|required',
            'tgl_penyulaman' => 'sometimes|required|date',
            'jml_rumpun' => 'sometimes|required|integer',
        ]);

        $penyulaman->update($validatedData);

        return response()->json($penyulaman, 200);
    }
   
    // Delete a record
    public function destroy($id)
    {
        $penyulaman = Penyulaman::find($id);

        if (!$penyulaman) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $penyulaman->delete();

        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}
