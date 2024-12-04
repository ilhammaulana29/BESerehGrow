<?php

namespace App\Http\Controllers;
use App\Models\Distribusi;
use Illuminate\Http\Request;

class GrafikDistribusiBarangController extends Controller
{
    public function grafikDistribusi()
    {
        // Hitung jumlah data untuk masing-masing status
        $statusCounts = Distribusi::select('status_pengiriman')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status_pengiriman')
            ->get();

        // Strukturkan data agar sesuai untuk frontend
        $data = $statusCounts->map(function ($item) {
            return [
                'status' => $item->status_pengiriman,
                'total' => $item->total,
            ];
        });

        return response()->json([
            'message' => 'Data grafik distribusi berhasil diambil',
            'data' => $data,
        ]);
    }
}
