<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panen;
use App\Models\Penyulaman;
use App\Models\Land;

class AgendaPanenController extends Controller
{
    public function index()
    {
        try {
            $blocks = Land::with(['penyulaman:id_blok'])->get();

            $data = $blocks->map(function ($block) {
                // Ambil data panen terbaru berdasarkan blok
                $latestPanen = Panen::where('id_blok', $block->id_bloklahan)
                    ->orderBy('tgl_panen', 'desc') // Urutkan berdasarkan tanggal panen terbaru
                    ->first();

                // Hitung jumlah total data penyulaman + 1
                $totalPenyulaman = $block->penyulaman->count() + 1;

                // Hitung total panen
                $totalPanen = Panen::where('id_blok', $block->id_bloklahan)->count();

                // Proses data panen jika ada
                $panenData = $latestPanen
                    ? [
                        'tgl_panen' => $latestPanen->tgl_panen,
                        'tgl_panen_next' => date('Y-m-d', strtotime($latestPanen->tgl_panen . ' +3 months'))
                    ]
                    : null;

                return [
                    'id_blok' => $block->id_bloklahan,
                    'namablok' => $block->namablok,
                    'panen' => $panenData ? [$panenData] : [],
                    'total_panen' => $totalPanen,
                    'penyulaman_total' => $totalPenyulaman
                ];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
