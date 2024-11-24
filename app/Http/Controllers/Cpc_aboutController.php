<?php

namespace App\Http\Controllers;

use App\Models\Cpc_about;
use Illuminate\Http\Request;

class Cpc_aboutController extends Controller
{
    // GET All Companies
    public function index()
    {
        $companies = Cpc_about::all();
        return response()->json($companies);
    }

    // CREATE New Company
    public function store(Request $request)
    {
        $company = Cpc_about::create($request->all());
        return response()->json($company);
    }

    // GET a Single Company
    public function show($id)
    {
        $company = Cpc_about::find($id);
        return response()->json($company);
    }

    // UPDATE a Company
    public function update(Request $request, $id)
    {
        $company = Cpc_about::find($id);
        $company->update($request->all());
        return response()->json($company);
    }

    // DELETE a Company
    public function destroy($id)
    {
        Cpc_about::destroy($id);
        return response()->json('Company deleted');
    }
}
