<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenissimpanan;

class JenisSimpananController extends Controller
{
    public function index()
    {
        $statusKeanggotaan = Jenissimpanan::all();
        return response()->json([
            'success' => true,
            'data' => $statusKeanggotaan,
        ], 200);
    }
    public function getJenisSimpanan()
    {
        try {
            $jenisSimpanan = Jenissimpanan::select('id_jenissimpanan', 'nama_simpanan')->get();
            return response()->json($jenisSimpanan, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }
}
