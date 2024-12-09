<?php

namespace Database\Seeders;

use App\Models\Cpc_company_history;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cpc_company_history ::create([
            "judul"=> "M1",
            "sub_judul"=> "EVOS",
            "deskripsi"=> "EVOS VS RRQ",
        ]);
    }
}
