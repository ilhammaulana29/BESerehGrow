<?php

namespace Database\Seeders;

use App\Models\Company_address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company_address::create([
            'jalan' => 'celeng',
            'rt'=> '1',
            'rw'=> '2',
            'desa'=> 'celeng',
            'kecamatan'=> 'celeng',
            'kabupaten'=> 'indramayu',
            'provinsi'=> 'jawa barat',
            'kode_pos'=> '1234567',
        ]);
    }
}
