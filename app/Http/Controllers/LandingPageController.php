<?php

namespace App\Http\Controllers;

use App\Models\InfoSerehWangi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    public function getDataInfoSerehWangi()
    {
        $datas = InfoSerehWangi::all();
        return response()->json($datas);
    }


    public function showDataInfoSerehWangi($id)
    {
        $data = InfoSerehWangi::findOrFail($id);
        return response()->json($data);
    }


    public function updateDataInfoSerehWangi(Request $request, $id)
    {
        $data = InfoSerehWangi::findOrFail($id);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'deskripsi_sereh_wangi' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-landing-page/' . $data->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-landing-page', $filename, 'public');
            $data->gambar = $filename;
        }

        $data->deskripsi_sereh_wangi = $validatedData['deskripsi_sereh_wangi'];


        $data->save();

        return response()->json($data, 200);
    }
}
