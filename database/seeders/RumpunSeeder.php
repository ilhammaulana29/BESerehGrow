<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rumpun;

class RumpunSeeder extends Seeder
{
    public function run()
    {
        $rumpuns = [
            ['id_blok' => 1, 'nama_blok' => 'Blok A', 'jenis_rumpun' => 'Rumpun A', 'lebar_rumpun' => 1.0, 'tinggi_rumpun' => 2.0, 'warna_daun' => 'Hijau', 'lebar_daun' => 0.5, 'tekstur_daun' => 'Halus'],
            ['id_blok' => 2, 'nama_blok' => 'Blok B', 'jenis_rumpun' => 'Rumpun B', 'lebar_rumpun' => 1.5, 'tinggi_rumpun' => 2.5, 'warna_daun' => 'Hijau Tua', 'lebar_daun' => 0.7, 'tekstur_daun' => 'Kasar'],
            ['id_blok' => 3, 'nama_blok' => 'Blok C', 'jenis_rumpun' => 'Rumpun C', 'lebar_rumpun' => 1.8, 'tinggi_rumpun' => 3.0, 'warna_daun' => 'Kuning', 'lebar_daun' => 0.9, 'tekstur_daun' => 'Licin'],
            ['id_blok' => 4, 'nama_blok' => 'Blok D', 'jenis_rumpun' => 'Rumpun D', 'lebar_rumpun' => 2.0, 'tinggi_rumpun' => 3.5, 'warna_daun' => 'Hijau Kekuningan', 'lebar_daun' => 1.0, 'tekstur_daun' => 'Halus'],
            ['id_blok' => 5, 'nama_blok' => 'Blok E', 'jenis_rumpun' => 'Rumpun E', 'lebar_rumpun' => 2.2, 'tinggi_rumpun' => 4.0, 'warna_daun' => 'Hijau Muda', 'lebar_daun' => 1.2, 'tekstur_daun' => 'Kasar'],
            ['id_blok' => 6, 'nama_blok' => 'Blok F', 'jenis_rumpun' => 'Rumpun F', 'lebar_rumpun' => 2.5, 'tinggi_rumpun' => 4.5, 'warna_daun' => 'Coklat Kehijauan', 'lebar_daun' => 1.5, 'tekstur_daun' => 'Kasar'],
            ['id_blok' => 7, 'nama_blok' => 'Blok G', 'jenis_rumpun' => 'Rumpun G', 'lebar_rumpun' => 2.8, 'tinggi_rumpun' => 5.0, 'warna_daun' => 'Hijau Gelap', 'lebar_daun' => 1.8, 'tekstur_daun' => 'Licin'],
            ['id_blok' => 8, 'nama_blok' => 'Blok H', 'jenis_rumpun' => 'Rumpun H', 'lebar_rumpun' => 3.0, 'tinggi_rumpun' => 5.5, 'warna_daun' => 'Hijau Zaitun', 'lebar_daun' => 2.0, 'tekstur_daun' => 'Halus'],
            ['id_blok' => 9, 'nama_blok' => 'Blok I', 'jenis_rumpun' => 'Rumpun I', 'lebar_rumpun' => 3.2, 'tinggi_rumpun' => 6.0, 'warna_daun' => 'Kuning Tua', 'lebar_daun' => 2.5, 'tekstur_daun' => 'Licin'],
            ['id_blok' => 10, 'nama_blok' => 'Blok J', 'jenis_rumpun' => 'Rumpun J', 'lebar_rumpun' => 3.5, 'tinggi_rumpun' => 6.5, 'warna_daun' => 'Hijau Lumut', 'lebar_daun' => 3.0, 'tekstur_daun' => 'Kasar'],
        ];

        Rumpun::insert($rumpuns);
    }
}

