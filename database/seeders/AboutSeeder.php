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
            'visi'=> 'voya',
            'misi' => 'voya',
            'kebijakan' => 'ayoayoayo',
            'ketentuan' => 'persija',
        ]);
    }
}
