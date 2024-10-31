<?php

// app/Http/Controllers/BudidayaController.php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudidayaController extends Controller
{
    public function index()
    {
        return response()->json(Budidaya::all());
    }

    public function show($id)
    {
        $budidaya = Budidaya::findOrFail($id);
        return response()->json($budidaya);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'additionalinfo' => 'nullable|string',
        ]);
        

        if ($request->hasFile('gambar')) {
            $data['image_path'] = $request->file('gambar')->store('images/budidaya', 'public');
        }

        $budidaya = Budidaya::create($data);
        return response()->json($budidaya);
    }

    public function update(Request $request, $id)
{
    $budidaya = Budidaya::findOrFail($id);

    // Validate and update
    $validatedData = $request->validate([
        'judul' => 'required|string',
        'subtitle' => 'string|nullable',
        'deskripsi' => 'string|nullable',
        'additionalinfo' => 'string|nullable',
        'gambar' => 'file|image|max:2048' // Adjust as needed
    ]);

    // Update fields
    $budidaya->judul = $validatedData['judul'];
    $budidaya->subtitle = $validatedData['subtitle'];
    $budidaya->deskripsi = $validatedData['deskripsi'];
    $budidaya->additionalinfo = $validatedData['additionalinfo'];

    // Handle image upload if present
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('budidaya_images', 'public');
        $budidaya->image_path = $path;
    }

    $budidaya->save();

    return response()->json(['message' => 'Data updated successfully.']);
}


    public function destroy($id)
    {
        $budidaya = Budidaya::findOrFail($id);
        if ($budidaya->image_path) {
            Storage::disk('public')->delete($budidaya->image_path);
        }
        $budidaya->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
