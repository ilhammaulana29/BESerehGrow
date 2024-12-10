<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    // Get all entries
    public function index()
    {
        $lands = Land::all();
        return $lands->map(function ($land) {
            foreach ($land->toArray() as $key => $value) {
                if (is_numeric($value)) {
                    $land[$key] = floatval($value);
                }
            }
            return $land;
        });
    }

    // Create a new entry
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namablok' => 'required|string|max:255',
            'luasblok' => 'required|numeric',
            'jumlah_rumpun' => 'required|integer',
            'totalproduksidaun' => 'required|numeric',
            'jarak_tanam' => 'required|numeric',
            'kemiringan' => 'required|numeric',
            'unsurhara' => 'required|string|max:255',
            'jenis_rumpun' => 'required|string|max:255',
        ]);

        return Land::create($validatedData);
    }

    // Show a specific entry
    public function show($id)
    {
        return Land::findOrFail($id);
    }

    // Fetch Nama Blok data
    public function getNamaBlok()
    {
        $blokLahanData = Land::all();
        $namaBlokResponse = $blokLahanData->map(function ($item) {
            return [
                'namablok' => $item->namablok,
                'id_bloklahan' => $item->id_bloklahan,
                'jenis_rumpun' => $item->jenis_rumpun,
            ];
        });
        return response()->json($namaBlokResponse);
    }

    // Update an entry
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'namablok' => 'required|string|max:255',
            'luasblok' => 'required|numeric',
            'jumlah_rumpun' => 'required|integer',
            'totalproduksidaun' => 'required|numeric',
            'jarak_tanam' => 'required|numeric',
            'kemiringan' => 'required|numeric',
            'unsurhara' => 'nullable',
            'jenis_rumpun' => 'required|string|max:255',
        ]);

        $blokLahan = Land::findOrFail($id);
        $blokLahan->update($validatedData);

        return response()->json($blokLahan, 200);
    }

    // Delete an entry
    public function destroy($id)
    {
        $blokLahan = Land::findOrFail($id);
        $blokLahan->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
