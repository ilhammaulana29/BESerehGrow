<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class Mitracontroller extends Controller
{
    // GET All Mitras
    public function index()
    {
        $mitras = Mitra::all();
        return response()->json($mitras);
    }

    // CREATE New Mitra
    public function store(Request $request)
    {
        $mitra = Mitra::create($request->all());
        return response()->json($mitra, 201);
    }

    // GET a Single Mitra
    public function show($id)
    {
        $mitra = Mitra::find($id);

        if (!$mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json($mitra);
    }

    // UPDATE a Mitra
    public function update(Request $request, $id)
    {
        $mitra = Mitra::find($id);

        if (!$mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        $mitra->update($request->all());
        return response()->json($mitra);
    }

    // DELETE a Mitra
    public function destroy($id)
    {
        $mitra = Mitra::find($id);

        if (!$mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        $mitra->delete();
        return response()->json(['message' => 'Mitra deleted']);
    }
}
