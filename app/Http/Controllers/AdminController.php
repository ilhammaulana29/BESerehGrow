<?php

// namespace App\Http\Controllers;

// use App\Models\Admin;
// use App\Models\AdminAddress;
// use App\Models\AdminDetail;
// use App\Models\AdminPermit;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class AdminController extends Controller
// {
//     public function index()
// {
//     $admins = Admin::with(['adminAddress', 'adminDetail','adminPermit'])->get();

//     $data = $admins->map(function ($admin) {
//         return [
//             'id_admin' => $admin->id_admin,
//             'email' => $admin->email,
//             'id_adminpmnt' => $admin->id_adminpmnt,
//             'password'=> $admin->password,
//             'permit' => $admin->adminPermit ? [
//                 'permitacces' => $admin->adminPermit->permitacces,
//             ] : null,
//             'address' => $admin->adminAddress ? [
//                 'jalan' => $admin->adminAddress->jalan,
//                 'no_rumah' => $admin->adminAddress->no_rumah,
//                 'no_rt' => $admin->adminAddress->no_rt,
//                 'no_rw' => $admin->adminAddress->no_rw,
//                 'desa_kelurahan' => $admin->adminAddress->desa_kelurahan,
//                 'kecamatan' => $admin->adminAddress->kecamatan,
//                 'kabupaten' => $admin->adminAddress->kabupaten,
//                 'provinsi' => $admin->adminAddress->provinsi,
//                 'kode_pos' => $admin->adminAddress->kode_pos,
//             ] : null,
//             'detail' => $admin->adminDetail ? [
//                 'nama_lengkap' => $admin->adminDetail->nama_lengkap,
//                 'nohp' => $admin->adminDetail->nohp,
//             ] : null,
//         ];
//     });

//     return response()->json($data, 200);
// }


//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'id_adminpmnt' => 'required|exists:admin_permits,id_adminpmnt',
//             'email' => 'required|email|unique:admins,email',
//             'password' => 'required|min:6',
//             'nama_lengkap' => 'required|string|max:255',
//             'nohp' => 'required|string',
//             'jalan' => 'required|string',
//             'no_rumah' => 'required|string',
//             'no_rt' => 'required|string',
//             'no_rw' => 'required|string',
//             'desa_kelurahan' => 'required|string',
//             'kecamatan' => 'required|string',
//             'kabupaten' => 'required|string',
//             'provinsi' => 'required|string',
//             'kode_pos' => 'required|string',
//         ]);

//         $admin = Admin::create([
//             'id_adminpmnt' => $validated['id_adminpmnt'],
//             'email' => $validated['email'],
//             'password' => bcrypt($validated['password']),
//         ]);

//         $address = AdminAddress::create($validated);

//         AdminDetail::create([
//             'id_admin' => $admin->id_admin,
//             'id_adminaddress' => $address->id_adminaddress,
//             'nama_lengkap' => $validated['nama_lengkap'],
//             'nohp' => $validated['nohp'],
//         ]);

//         return response()->json(['message' => 'Admin created successfully'], 201);
//     }
//     public function update(Request $request, $id)
// {
//     $validator = Validator::make($request->all(), [
//         'id_adminpmnt' => 'required|exists:admin_permits,id_adminpmnt',
//         'email' => 'required|email|unique:admins,email,' . $id, // Ignore email untuk admin ini
//         'password' => 'nullable|min:6',
//         'nama_lengkap' => 'required|string|max:255',
//         'nohp' => 'required|string',
//         'jalan' => 'required|string',
//         'no_rumah' => 'required|string',
//         'no_rt' => 'required|string',
//         'no_rw' => 'required|string',
//         'desa_kelurahan' => 'required|string',
//         'kecamatan' => 'required|string',
//         'kabupaten' => 'required|string',
//         'provinsi' => 'required|string',
//         'kode_pos' => 'required|string',
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()], 422);
//     }

//     try {
//         $admin = Admin::with(['adminAddress', 'adminDetail'])->findOrFail($id);

//         // Update Admin data
//         $admin->update([
//             'id_adminpmnt' => $request->id_adminpmnt,
//             'email' => $request->email,
//             'password' => $request->password ? bcrypt($request->password) : $admin->password,
//         ]);

//         // Update Address data
//         if ($admin->adminAddress) {
//             $admin->adminAddress->update([
//                 'jalan' => $request->jalan,
//                 'no_rumah' => $request->no_rumah,
//                 'no_rt' => $request->no_rt,
//                 'no_rw' => $request->no_rw,
//                 'desa_kelurahan' => $request->desa_kelurahan,
//                 'kecamatan' => $request->kecamatan,
//                 'kabupaten' => $request->kabupaten,
//                 'provinsi' => $request->provinsi,
//                 'kode_pos' => $request->kode_pos,
//             ]);
//         }

//         // Update Detail data
//         if ($admin->adminDetail) {
//             $admin->adminDetail->update([
//                 'nama_lengkap' => $request->nama_lengkap,
//                 'nohp' => $request->nohp,
//             ]);
//         }

//         return response()->json(['message' => 'Admin updated successfully'], 200);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to update admin: ' . $e->getMessage()], 500);
//     }
// }


// }

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminAddress;
use App\Models\AdminDetail;
use App\Models\AdminPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with(['adminAddress', 'adminDetail', 'adminPermit'])->get();

        $data = $admins->map(function ($admin) {
            return [
                'id_admin' => $admin->id_admin,
                'email' => $admin->email,
                'id_adminpmnt' => $admin->id_adminpmnt,
                'password' => $admin->password,
                'permit' => $admin->adminPermit ? [
                    'permitacces' => $admin->adminPermit->permitacces,
                ] : null,
                'address' => $admin->adminAddress ? [
                    'jalan' => $admin->adminAddress->jalan,
                    'no_rumah' => $admin->adminAddress->no_rumah,
                    'no_rt' => $admin->adminAddress->no_rt,
                    'no_rw' => $admin->adminAddress->no_rw,
                    'desa_kelurahan' => $admin->adminAddress->desa_kelurahan,
                    'kecamatan' => $admin->adminAddress->kecamatan,
                    'kabupaten' => $admin->adminAddress->kabupaten,
                    'provinsi' => $admin->adminAddress->provinsi,
                    'kode_pos' => $admin->adminAddress->kode_pos,
                ] : null,
                'detail' => $admin->adminDetail ? [
                    'nama_lengkap' => $admin->adminDetail->nama_lengkap,
                    'nohp' => $admin->adminDetail->nohp,
                ] : null,
            ];
        });

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_adminpmnt' => 'required|exists:admin_permits,id_adminpmnt',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required|string|max:255',
            'nohp' => 'required|string',
            'jalan' => 'required|string',
            'no_rumah' => 'required|string',
            'no_rt' => 'required|string',
            'no_rw' => 'required|string',
            'desa_kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
        ]);

        $admin = Admin::create([
            'id_adminpmnt' => $validated['id_adminpmnt'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $address = AdminAddress::create($validated);

        AdminDetail::create([
            'id_admin' => $admin->id_admin,
            'id_adminaddress' => $address->id_adminaddress,
            'nama_lengkap' => $validated['nama_lengkap'],
            'nohp' => $validated['nohp'],
        ]);

        return response()->json(['message' => 'Admin created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_adminpmnt' => 'required|exists:admin_permits,id_adminpmnt',
            'email' => 'required|email|unique:admins,email,' . $id . ',id_admin',
            'password' => 'nullable|min:6',
            'nama_lengkap' => 'required|string|max:255',
            'nohp' => 'required|string',
            'jalan' => 'required|string',
            'no_rumah' => 'required|string',
            'no_rt' => 'required|string',
            'no_rw' => 'required|string',
            'desa_kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        try {
            $admin = Admin::with(['adminAddress', 'adminDetail'])->findOrFail($id);
    
            // Update Admin
            $admin->update([
                'id_adminpmnt' => $request->id_adminpmnt,
                'email' => $request->email,
                'password' => $request->filled('password') ? bcrypt($request->password) : $admin->password,
            ]);
    
            // Update AdminAddress
            if ($admin->adminAddress) {
                $admin->adminAddress->update([
                    'jalan' => $request->jalan,
                    'no_rumah' => $request->no_rumah,
                    'no_rt' => $request->no_rt,
                    'no_rw' => $request->no_rw,
                    'desa_kelurahan' => $request->desa_kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'kode_pos' => $request->kode_pos,
                ]);
            }
    
            // Update AdminDetail
            if ($admin->adminDetail) {
                $admin->adminDetail->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'nohp' => $request->nohp,
                ]);
            }
    
            return response()->json(['message' => 'Admin updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update admin: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
{
    try {
        $admin = Admin::with(['adminAddress', 'adminDetail', 'adminPermit'])->findOrFail($id);

        $data = [
            'id_admin' => $admin->id_admin,
            'email' => $admin->email,
            'id_adminpmnt' => $admin->id_adminpmnt,
            'password' => $admin->password,
            'permit' => $admin->adminPermit ? [
                'permitacces' => $admin->adminPermit->permitacces,
            ] : null,
            'address' => $admin->adminAddress ? [
                'jalan' => $admin->adminAddress->jalan,
                'no_rumah' => $admin->adminAddress->no_rumah,
                'no_rt' => $admin->adminAddress->no_rt,
                'no_rw' => $admin->adminAddress->no_rw,
                'desa_kelurahan' => $admin->adminAddress->desa_kelurahan,
                'kecamatan' => $admin->adminAddress->kecamatan,
                'kabupaten' => $admin->adminAddress->kabupaten,
                'provinsi' => $admin->adminAddress->provinsi,
                'kode_pos' => $admin->adminAddress->kode_pos,
            ] : null,
            'detail' => $admin->adminDetail ? [
                'nama_lengkap' => $admin->adminDetail->nama_lengkap,
                'nohp' => $admin->adminDetail->nohp,
            ] : null,
        ];

        return response()->json($data, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Admin not found: ' . $e->getMessage()], 404);
    }
}

public function destroy($id)
{
    try {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Delete related address and detail if exist
        if ($admin->adminAddress) {
            $admin->adminAddress->delete();
        }

        if ($admin->adminDetail) {
            $admin->adminDetail->delete();
        }

        // Delete the admin
        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete admin: ' . $e->getMessage()], 500);
    }
}

    
}