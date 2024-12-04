<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Land; // Model untuk cm_bloklahan
use App\Models\Panen; // Model untuk cm_panen
use App\Models\Plasma; // Model untuk cm_plasma

class StatistikController extends Controller
{
    /**
     * Mengambil statistik yang diminta.
     */
    public function getStats()
    {
        try {
            // 1. Jumlah nama blok
            $jumlahNamaBlok = Land::distinct('namablok')->count('namablok');

            // 2. Total luas semua blok
            $totalLuasBlok = Land::sum('luasblok');

            // 3. Jumlah total semua rumpun
            $totalJumlahRumpun = Land::sum('jumlah_rumpun');

            // 4. Jumlah total berat daun dari tabel cm_panen
            $totalBeratDaunPanen = Panen::sum('berat_daun');

            // 5. Jumlah total berat daun dari tabel cm_plasma
            $totalBeratDaunPlasma = Plasma::sum('berat_daun');

            // Kembalikan data sebagai JSON
            return response()->json([
                'jumlah_namablok' => $jumlahNamaBlok,
                'total_luasblok' => $totalLuasBlok,
                'total_jumlah_rumpun' => $totalJumlahRumpun,
                'total_berat_daun_panen' => $totalBeratDaunPanen,
                'total_berat_daun_plasma' => $totalBeratDaunPlasma,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
