<?php

namespace App\Http\Controllers;

use App\Models\Plasma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlasmaController extends Controller
{
    public function index()
    {
        // return response()->json(Plasma::all());
        $plasmas = Plasma::all();
        return $plasmas->map(function ($plasma) {
            foreach ($plasma->toArray() as $key => $value) {
                if (is_numeric($value)) {
                    $plasma[$key] = floatval($value); // Ubah ke float
                }
            }
            return $plasma;
        });
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
        Log::info("Update request for Plasma ID: $id", $request->all());
        try {
            $plasma = Plasma::findOrFail($id);
            $validatedData = $request->validate([
                'nama_petani' => 'required|string|max:255',
                'berat_daun' => 'required|numeric',
                'jenis_rumpun' => 'required|string|max:255',
                'total_harga' => 'required|numeric',
                'tanggal_setor' => 'required|date',
            ]);
    
            Log::info("Validated data:", $validatedData);
            $plasma->update($validatedData);
            return response()->json(['message' => 'Plasma updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error("Error updating Plasma: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update Plasma data'], 500);
        }
    }
    

    public function destroy($id)
    {
        $plasma = Plasma::findOrFail($id);
        $plasma->delete();

        return response()->json(['message' => 'Plasma record deleted successfully']);
    }
}
