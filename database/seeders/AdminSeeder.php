<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Data untuk admin_permits
        // $permits = [
        //     ['permitacces' => 'Full Access'],
        //     ['permitacces' => 'Limited Access'],
        // ];

        // // Menambahkan data ke admin_permits
        // DB::table('admin_permits')->insert($permits);

        // Data untuk admins
        $admins = [
            [
                'id_admin' => 10,
                'email' => 'ilhamgadingan@gmail.com',
                'password' => Hash::make('1234567890'),
                'id_adminpmnt' => 2,
            ],
            [
                'id_admin' => 11,
                'email' => 'wisnuben10@gmail.com',
                'password' => Hash::make('1234567890'),
                'id_adminpmnt' => 2,
            ],
            [
                'id_admin' => 12,
                'email' => 'wakapolri@gmail.com',
                'password' => Hash::make('1234567890'),
                'id_adminpmnt' => 2,
            ],
            [
                'id_admin' => 13,
                'email' => 'gondrong69@gmail.com',
                'password' => Hash::make('1234567890'),
                'id_adminpmnt' => 2,
            ],
        ];

        // Menambahkan data ke admins
        $adminIds = [];
        foreach ($admins as $admin) {
            $adminIds[] = DB::table('admins')->insertGetId($admin);
        }

        // Data untuk admin_addresses
        $addresses = [
            [
                'id_adminaddress' => 10,
                'jalan' => 'Jl, PU Gadingan',
                'no_rumah' => '99',
                'no_rt' => '09',
                'no_rw' => '09',
                'desa_kelurahan' => 'Gadingan',
                'kecamatan' => 'Jatibarang',
                'kabupaten' => 'Indramayu',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '45281',
            ],
            [
                'id_adminaddress' => 11,
                'jalan' => 'Jl. leuwigede',
                'no_rumah' => '10',
                'no_rt' => '10',
                'no_rw' => '10',
                'desa_kelurahan' => 'Leuwigede',
                'kecamatan' => 'Lohbener',
                'kabupaten' => 'Indramayu',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '12345',
            ],
            [
                'id_adminaddress' => 12,
                'jalan' => 'Jl. Tegal Urung',
                'no_rumah' => '01',
                'no_rt' => '01',
                'no_rw' => '01',
                'desa_kelurahan' => 'Tegal Urung',
                'kecamatan' => 'Balongan',
                'kabupaten' => 'Indramayu',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '12345',
            ],
            [
                'id_adminaddress' => 13,
                'jalan' => 'Jl. Raya Jatibarang  Indramayu ',
                'no_rumah' => '69',
                'no_rt' => '69',
                'no_rw' => '86',
                'desa_kelurahan' => 'Telukagung',
                'kecamatan' => 'Indramayu',
                'kabupaten' => 'Indramayu',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '12345',
            ],
        ];

        // Menambahkan data ke admin_addresses
        $addressIds = [];
        foreach ($addresses as $address) {
            $addressIds[] = DB::table('admin_addresses')->insertGetId($address);
        }

        // Data untuk admin_details
        $details = [
            [
                'id_admin' => 10,
                'id_adminaddress' => 10,
                'nama_lengkap' => 'Ilham Maulana Hakim Pamungkas',
                'nohp' => '08123456789',
            ],
            [
                'id_admin' => 11,
                'id_adminaddress' => 11,
                'nama_lengkap' => 'Wisnuben Arif Nasution',
                'nohp' => '08129876543',
            ],
            [
                'id_admin' => 12,
                'id_adminaddress' => 12,
                'nama_lengkap' => 'Akmal Akhzari (Ponakan WAKAPOLRI)',
                'nohp' => '08129876543',
            ],
            [
                'id_admin' => 13,
                'id_adminaddress' => 13,
                'nama_lengkap' => 'FarhanRfz Gondrong anak 10',
                'nohp' => '08129876543',
            ],
        ];

        // Menambahkan data ke admin_details
        DB::table('admin_details')->insert($details);
    }
}
