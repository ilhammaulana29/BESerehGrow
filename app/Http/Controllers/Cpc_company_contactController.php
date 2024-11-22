<?php

namespace App\Http\Controllers;

use App\Models\Cpc_company_contact;
use Illuminate\Http\Request;

class Cpc_company_contactController extends Controller
{
    // GET All Contacts
    public function index()
    {
        $contacts = Cpc_company_contact::all();
        return response()->json($contacts);
    }

    // CREATE New Contact
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_contact' => 'required|string',
            'url_contact' => 'required|url',
        ]);

        $contact = Cpc_company_contact::create($validated);
        return response()->json($contact);
    }

    // GET a Single Contact
    public function show($id)
    {
        $contact = Cpc_company_contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Kontak tidak ditemukan'], 404);
        }
        return response()->json($contact);
    }

    // UPDATE a Contact
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_kontak' => 'required|string',
            'link_kontak' => 'required|url',
        ]);

        $contact = Cpc_company_contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Kontak tidak ditemukan'], 404);
        }

        $contact->update($validated);
        return response()->json(['message' => 'Kontak berhasil diperbarui', 'data' => $contact]);
    }

    // DELETE a Contact
    public function deleteContact($id)
    {
        $contact = Cpc_company_contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Kontak berhasil dihapus'], 200);
    }
}
