<?php

namespace Database\Seeders;

use App\Models\Cpc_about;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cpc_about::create([
            'gambar_perusahaan' => 'logo',
            'nama_perusahaan'=> 'tes',
            'latar_belakang'=> 'tes',
            'visi'=> 'tes',
            'misi' => 'tes',
        ]);
    }
}
