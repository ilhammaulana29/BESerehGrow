<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminPermit;

class AdminPermitSeeder extends Seeder
{
    public function run()
    {
        AdminPermit::insert([
            ['permitacces' => 'admin-konten'],
            ['permitacces' => 'super admin'],
            ['permitacces' => 'admin-koperasi'],
            ['permitacces' => 'admin-budidaya-serehwangi'],
            ['permitacces' => 'admin-kelola-konten'],
            ['permitacces' => 'admin-pengolahan-serehwangi'],
            ['permitacces' => 'admin-analisis-potensi-lahan']
        ]);
    }
}
