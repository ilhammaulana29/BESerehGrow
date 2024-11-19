<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    // Get all entries
    public function index()
    {
        return Land::all();
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
            'jenis_rumpun' => 'required|in:G2,G3,Balon',
        ]);

        return Land::create($validatedData);
    }

    // Show a specific entry
    public function show($id)
    {
        return Land::findOrFail($id);
    }

    public function getNamaBlok()
    {
        // Fetch data from the BlokLahan model
        $blokLahanData = Land::all(); // Adjust the query based on your needs

        // Transform the data into the desired format
        $namaBlokResponse = $blokLahanData->map(function ($item) {
            return [
                'namablok' => $item->namablok,
                'id_bloklahan' => $item->id_bloklahan,
                'jenis_rumpun' => $item->jenis_rumpun // Adjust based on your model attributes
            ];
        });

        // Return response as JSON
        return response()->json($namaBlokResponse);
    }
    
    // Update an entry
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'namablok' => 'required|string|max:255',
            'luasblok' => 'required|numeric',
            'jumlah_rumpun' => 'required|integer',
            'totalproduksidaun' => 'required|numeric',
            'jarak_tanam' => 'required|numeric',
            'kemiringan' => 'required|numeric',
            'unsurhara' => 'required|string|max:255',
            'jenis_rumpun' => 'required|in:G2,G3,Balon',
        ]);
    
        // Find the existing record by ID
        $blokLahan = Land::findOrFail($id);
        
        // Update the record with validated data
        $blokLahan->update($validatedData);
    
        // Return the updated record as a response
        return response()->json($blokLahan, 200);
    }
    

    // Delete an entry
    public function destroy($id)
    {
        $blokLahan = Land::findOrFail($id);
        $blokLahan->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
