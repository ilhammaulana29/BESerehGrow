<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminPermit;

class AdminPermitSeeder extends Seeder
{
    public function run()
    {
        AdminPermit::insert([
            ['permitacces' => 'admin'],
            ['permitacces' => 'super admin']
        ]);
    }
}
