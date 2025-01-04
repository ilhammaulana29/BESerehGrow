<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Karyawan;
use Illuminate\Http\JsonResponse;

class DashboardACMController extends Controller
{
    /**
     * Get summary data for dashboard
     *
     * @return JsonResponse
     */
    public function getSummary(): JsonResponse
    {
        // Hitung jumlah admin
        $totalAdmins = Admin::count();

        // Hitung jumlah karyawan
        $totalKaryawan = Karyawan::count();

        // Hitung total gaji pokok semua karyawan
        $totalGajiPokok = Karyawan::sum('gaji_pokok');

        // Return data sebagai JSON
        return response()->json([
            'total_admins' => $totalAdmins,
            'total_karyawan' => $totalKaryawan,
            'total_gaji_pokok' => $totalGajiPokok,
        ]);
    }
}
