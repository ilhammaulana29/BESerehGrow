<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panen;

class PanenSeeder extends Seeder
{
    public function run()
    {
        $panens = [
            ['id_blok' => 1, 'nama_blok' => 'Blok A', 'tgl_panen' => '2024-12-01', 'berat_daun' => 100.5, 'jumlah_ikat' => 10, 'total_berat_daun' => 105.5],
            ['id_blok' => 2, 'nama_blok' => 'Blok B', 'tgl_panen' => '2024-12-02', 'berat_daun' => 200.0, 'jumlah_ikat' => 20, 'total_berat_daun' => 210.0],
            ['id_blok' => 3, 'nama_blok' => 'Blok C', 'tgl_panen' => '2024-12-03', 'berat_daun' => 150.5, 'jumlah_ikat' => 15, 'total_berat_daun' => 165.5],
            ['id_blok' => 4, 'nama_blok' => 'Blok D', 'tgl_panen' => '2024-12-04', 'berat_daun' => 300.0, 'jumlah_ikat' => 25, 'total_berat_daun' => 325.0],
            ['id_blok' => 5, 'nama_blok' => 'Blok E', 'tgl_panen' => '2024-12-05', 'berat_daun' => 250.0, 'jumlah_ikat' => 18, 'total_berat_daun' => 268.0],
            ['id_blok' => 6, 'nama_blok' => 'Blok F', 'tgl_panen' => '2024-12-06', 'berat_daun' => 180.5, 'jumlah_ikat' => 12, 'total_berat_daun' => 192.5],
            ['id_blok' => 7, 'nama_blok' => 'Blok G', 'tgl_panen' => '2024-12-07', 'berat_daun' => 220.0, 'jumlah_ikat' => 22, 'total_berat_daun' => 242.0],
            ['id_blok' => 8, 'nama_blok' => 'Blok H', 'tgl_panen' => '2024-12-08', 'berat_daun' => 320.5, 'jumlah_ikat' => 30, 'total_berat_daun' => 350.5],
            ['id_blok' => 9, 'nama_blok' => 'Blok I', 'tgl_panen' => '2024-12-09', 'berat_daun' => 400.0, 'jumlah_ikat' => 40, 'total_berat_daun' => 440.0],
            ['id_blok' => 10, 'nama_blok' => 'Blok J', 'tgl_panen' => '2024-12-10', 'berat_daun' => 500.0, 'jumlah_ikat' => 50, 'total_berat_daun' => 550.0],
        ];

        Panen::insert($panens);
    }
}
