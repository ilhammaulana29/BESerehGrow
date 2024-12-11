<?php

namespace App\Http\Controllers;

use App\Models\Cpc_about;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Cpc_aboutController extends Controller
{
    public function index()
    {
        $companies = Cpc_about::all();
        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'latar_belakang' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar_perusahaan' => 'nullable|image|mimes:jpg,png,jpeg|max:3072',
        ]);

        $company = new Cpc_about($validatedData);

        if ($request->hasFile('gambar_perusahaan')) {
            $file = $request->file('gambar_perusahaan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/logo', $fileName);
            $company->gambar_perusahaan = $fileName;
        }

        $company->save();
        return response()->json($company, 201);
    }

    public function show($id)
    {
        $about = Cpc_about::find($id);
        if (!$about) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($about);
    }

    public function update(Request $request, $id)
    {
        $about = Cpc_about::find($id);
    
        if (!$about) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Validasi input
        $validatedData = $request->validate([
            'nama_perusahaan' => 'nullable|string|max:255',
            'latar_belakang' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'gambar_perusahaan' => 'nullable|image|mimes:jpg,png,jpeg|max:10240',
        ]);
    
        // Jika ada file gambar yang dikirimkan
        if ($request->hasFile('gambar_perusahaan')) {
            if ($about->gambar_perusahaan && Storage::exists('public/logo/' . $about->gambar_perusahaan)) {
                // Hapus file lama
                Storage::delete('public/logo/' . $about->gambar_perusahaan);
            }
    
            // Simpan file gambar baru
            $file = $request->file('gambar_perusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('logo', $filename, 'public');
            $about->gambar_perusahaan = $filename;
        }
    
        // Update hanya field lain yang disediakan dalam request
        $about->nama_perusahaan = $validatedData['nama_perusahaan'] ?? $about->nama_perusahaan;
        $about->latar_belakang = $validatedData['latar_belakang'] ?? $about->latar_belakang;
        $about->visi = $validatedData['visi'] ?? $about->visi;
        $about->misi = $validatedData['misi'] ?? $about->misi;
    
        $about->save();
    
        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $about,
        ], 200);
    }
    

    

    public function destroy($id)
    {
        $about = Cpc_about::find($id);
        if (!$about) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        if ($about->gambar_perusahaan && Storage::exists('public/logo/' . $about->gambar_perusahaan)) {
            Storage::delete('public/logo/' . $about->gambar_perusahaan);
        }

        $about->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}