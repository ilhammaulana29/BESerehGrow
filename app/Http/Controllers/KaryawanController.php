<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\KaryawanAddress;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('address')->get();
        return response()->json($karyawans);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'pekerjaan' => 'required|string',
            'upah_harian' => 'required|numeric',
            'gaji_pokok' => 'required|numeric',
            'address.jalan' => 'required|string',
            'address.no_rumah' => 'required|string',
            'address.no_rt' => 'required|string',
            'address.no_rw' => 'required|string',
            'address.desa_kelurahan' => 'required|string',
            'address.kecamatan' => 'required|string',
            'address.kabupaten' => 'required|string',
            'address.provinsi' => 'required|string',
            'address.kode_pos' => 'required|string',
        ]);

        $address = KaryawanAddress::create($request->address);
        $karyawan = Karyawan::create([
            'id_karyawanaddress' => $address->id_karyawanaddress,
            'nama_lengkap' => $request->nama_lengkap,
            'pekerjaan' => $request->pekerjaan,
            'upah_harian' => $request->upah_harian,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        return response()->json($karyawan, 201);
    }

    // public function show($id)
    // {
    //     $karyawan = Karyawan::with('address')->findOrFail($id);
    //     return response()->json($karyawan);
    // }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'sometimes|required|string',
            'pekerjaan' => 'sometimes|required|string',
            'upah_harian' => 'sometimes|required|numeric',
            'gaji_pokok' => 'sometimes|required|numeric',
            'address.jalan' => 'sometimes|required|string',
            'address.no_rumah' => 'sometimes|required|string',
            'address.no_rt' => 'sometimes|required|string',
            'address.no_rw' => 'sometimes|required|string',
            'address.desa_kelurahan' => 'sometimes|required|string',
            'address.kecamatan' => 'sometimes|required|string',
            'address.kabupaten' => 'sometimes|required|string',
            'address.provinsi' => 'sometimes|required|string',
            'address.kode_pos' => 'sometimes|required|string',
        ]);

        $karyawan->update($request->only('nama_lengkap', 'pekerjaan', 'upah_harian', 'gaji_pokok'));
        $karyawan->address()->update($request->address);

        return response()->json($karyawan);
    }

    public function show($id)
{
    try {
        // Ambil data karyawan beserta relasi alamatnya
        $karyawan = Karyawan::with('address')->findOrFail($id);

        // Susun data JSON untuk respon
        $data = [
            'id_karyawan' => $karyawan->id_karyawan,
            'nama_lengkap' => $karyawan->nama_lengkap,
            'pekerjaan' => $karyawan->pekerjaan,
            'upah_harian' => $karyawan->upah_harian,
            'gaji_pokok' => $karyawan->gaji_pokok,
            'address' => $karyawan->address ? [
                'jalan' => $karyawan->address->jalan,
                'no_rumah' => $karyawan->address->no_rumah,
                'no_rt' => $karyawan->address->no_rt,
                'no_rw' => $karyawan->address->no_rw,
                'desa_kelurahan' => $karyawan->address->desa_kelurahan,
                'kecamatan' => $karyawan->address->kecamatan,
                'kabupaten' => $karyawan->address->kabupaten,
                'provinsi' => $karyawan->address->provinsi,
                'kode_pos' => $karyawan->address->kode_pos,
            ] : null,
        ];

        return response()->json($data, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Karyawan not found: ' . $e->getMessage()], 404);
    }
}

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return response()->json(['message' => 'Karyawan deleted successfully']);
    }
}
