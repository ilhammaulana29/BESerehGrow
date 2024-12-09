<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;

class PanenController extends Controller
{
    public function index()
    {
        // return response()->json(Panen::all());
        $panens = Panen::all();
        return $panens->map(function ($panen) {
            foreach ($panen->toArray() as $key => $value) {
                if (is_numeric($value)) {
                    $panen[$key] = floatval($value); // Ubah ke float
                }
            }
            return $panen;
        });
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
        try {
            // Find the record by ID
            $panen = Panen::findOrFail($id);

            // Validate and update with data from the request
            $validatedData = $request->validate([
                'id_blok' => 'required|exists:cm_bloklahan,id_bloklahan',
                'nama_blok' => 'required|string',
                'tgl_panen' => 'required|date',
                'berat_daun' => 'required|numeric',
                'jumlah_ikat' => 'required|numeric',
                'total_berat_daun' => 'required|numeric',
            ]);

            // Update the harvest record with validated data
            $panen->update($validatedData);

            // Return success response
            return response()->json(['message' => 'Harvest data updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle and return error response
            return response()->json(['message' => 'Error updating harvest data', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $panen = Panen::findOrFail($id);
        $panen->delete();

        // return response()->json(['message' => 'Panen record deleted successfully']);
        return response()->json(null, 204);
        
    }
}
