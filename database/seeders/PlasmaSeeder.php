<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plasma;

class PlasmaSeeder extends Seeder
{
    public function run()
    {
        $plasmas = [
            ['nama_petani' => 'Petani A', 'berat_daun' => 120.5, 'jenis_rumpun' => 'Rumpun A', 'total_harga' => 500000, 'tgl_setor' => '2024-12-01'],
            ['nama_petani' => 'Petani B', 'berat_daun' => 135.0, 'jenis_rumpun' => 'Rumpun B', 'total_harga' => 550000, 'tgl_setor' => '2024-12-02'],
            ['nama_petani' => 'Petani C', 'berat_daun' => 140.0, 'jenis_rumpun' => 'Rumpun C', 'total_harga' => 600000, 'tgl_setor' => '2024-12-03'],
            ['nama_petani' => 'Petani D', 'berat_daun' => 150.5, 'jenis_rumpun' => 'Rumpun D', 'total_harga' => 650000, 'tgl_setor' => '2024-12-04'],
            ['nama_petani' => 'Petani E', 'berat_daun' => 160.0, 'jenis_rumpun' => 'Rumpun E', 'total_harga' => 700000, 'tgl_setor' => '2024-12-05'],
            ['nama_petani' => 'Petani F', 'berat_daun' => 170.5, 'jenis_rumpun' => 'Rumpun F', 'total_harga' => 750000, 'tgl_setor' => '2024-12-06'],
            ['nama_petani' => 'Petani G', 'berat_daun' => 180.0, 'jenis_rumpun' => 'Rumpun G', 'total_harga' => 800000, 'tgl_setor' => '2024-12-07'],
            ['nama_petani' => 'Petani H', 'berat_daun' => 190.0, 'jenis_rumpun' => 'Rumpun H', 'total_harga' => 850000, 'tgl_setor' => '2024-12-08'],
            ['nama_petani' => 'Petani I', 'berat_daun' => 200.5, 'jenis_rumpun' => 'Rumpun I', 'total_harga' => 900000, 'tgl_setor' => '2024-12-09'],
            ['nama_petani' => 'Petani J', 'berat_daun' => 210.0, 'jenis_rumpun' => 'Rumpun J', 'total_harga' => 950000, 'tgl_setor' => '2024-12-10'],
        ];

        Plasma::insert($plasmas);
    }
}
