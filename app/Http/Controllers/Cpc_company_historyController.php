<?php

namespace App\Http\Controllers;

use App\Models\Cpc_company_history;
use Illuminate\Http\Request;

class Cpc_company_historyController extends Controller
{
     // GET All Companies
    public function index()
    {
        $history = Cpc_company_history::all();
        return response()->json($history);
    }

     // CREATE New Company
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string', // pastikan judul diisi
            'sub_judul' => 'required|string',
            'deskripsi' => 'required|string'
            // tambahkan validasi lain jika diperlukan
        ]);
    
        $company = Cpc_company_history::create($validatedData);
        return response()->json($company);
    }

     // GET a Single Company
    public function show($id)
    {
        $company = Cpc_company_history::find($id);
        return response()->json($company);
    }

     // UPDATE a Company
    public function update(Request $request, $id)
    {
        $company = Cpc_company_history::find($id);
        $company->update($request->all());
        return response()->json($company);
    }

     // DELETE a Company
    public function destroy($id)
    {
        Cpc_company_history::destroy($id);
        return response()->json('company history deleted');
    }
}
