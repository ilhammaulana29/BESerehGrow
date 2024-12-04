<?php

namespace App\Http\Controllers;
use App\Models\Penyulingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GrafikPenyulinganController extends Controller
{
    public function latestPenyulinganData()
    {
        $data = Penyulingan::select('tgl_penyulingan', 'banyak_minyak')
        ->orderBy('tgl_penyulingan', 'desc') // Urutkan berdasarkan tanggal penyulingan terbaru
        ->take(5) // Ambil hanya 5 data terbaru
        ->get()
        ->sortBy('tgl_penyulingan')
        ->values();
        

        Log::info('Data penyulingan (5 terbaru, diurutkan lama ke baru):', $data->toArray());

        return response()->json([
            'message' => 'Data grafik penyulingan berhasil diambil',
            'data' => $data,
        ]);
    }
}
