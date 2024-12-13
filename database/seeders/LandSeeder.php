<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Land;

class LandSeeder extends Seeder
{
    public function run()
    {
        $lands = [
            ['namablok' => 'Blok A', 'luasblok' => 100.0, 'jumlah_rumpun' => 50, 'totalproduksidaun' => 200.0, 'jarak_tanam' => 2.0, 'kemiringan' => 5.0, 'unsurhara' => 'Nitrogen', 'jenis_rumpun' => 'Rumpun A'],
            ['namablok' => 'Blok B', 'luasblok' => 150.0, 'jumlah_rumpun' => 75, 'totalproduksidaun' => 300.0, 'jarak_tanam' => 2.5, 'kemiringan' => 10.0, 'unsurhara' => 'Fosfor', 'jenis_rumpun' => 'Rumpun B'],
            ['namablok' => 'Blok C', 'luasblok' => 200.0, 'jumlah_rumpun' => 100, 'totalproduksidaun' => 400.0, 'jarak_tanam' => 3.0, 'kemiringan' => 15.0, 'unsurhara' => 'Kalium', 'jenis_rumpun' => 'Rumpun C'],
            ['namablok' => 'Blok D', 'luasblok' => 250.0, 'jumlah_rumpun' => 125, 'totalproduksidaun' => 500.0, 'jarak_tanam' => 3.5, 'kemiringan' => 20.0, 'unsurhara' => 'Magnesium', 'jenis_rumpun' => 'Rumpun D'],
            ['namablok' => 'Blok E', 'luasblok' => 300.0, 'jumlah_rumpun' => 150, 'totalproduksidaun' => 600.0, 'jarak_tanam' => 4.0, 'kemiringan' => 25.0, 'unsurhara' => 'Sulfur', 'jenis_rumpun' => 'Rumpun E'],
            ['namablok' => 'Blok F', 'luasblok' => 350.0, 'jumlah_rumpun' => 175, 'totalproduksidaun' => 700.0, 'jarak_tanam' => 4.5, 'kemiringan' => 30.0, 'unsurhara' => 'Kalsium', 'jenis_rumpun' => 'Rumpun F'],
            ['namablok' => 'Blok G', 'luasblok' => 400.0, 'jumlah_rumpun' => 200, 'totalproduksidaun' => 800.0, 'jarak_tanam' => 5.0, 'kemiringan' => 35.0, 'unsurhara' => 'Boron', 'jenis_rumpun' => 'Rumpun G'],
            ['namablok' => 'Blok H', 'luasblok' => 450.0, 'jumlah_rumpun' => 225, 'totalproduksidaun' => 900.0, 'jarak_tanam' => 5.5, 'kemiringan' => 40.0, 'unsurhara' => 'Zinc', 'jenis_rumpun' => 'Rumpun H'],
            ['namablok' => 'Blok I', 'luasblok' => 500.0, 'jumlah_rumpun' => 250, 'totalproduksidaun' => 1000.0, 'jarak_tanam' => 6.0, 'kemiringan' => 45.0, 'unsurhara' => 'Iron', 'jenis_rumpun' => 'Rumpun I'],
            ['namablok' => 'Blok J', 'luasblok' => 550.0, 'jumlah_rumpun' => 275, 'totalproduksidaun' => 1100.0, 'jarak_tanam' => 6.5, 'kemiringan' => 50.0, 'unsurhara' => 'Copper', 'jenis_rumpun' => 'Rumpun J'],
        ];

        Land::insert($lands);
    }
}
