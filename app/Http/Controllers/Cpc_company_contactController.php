<?php

namespace App\Http\Controllers;

use App\Models\Cpc_company_contact;
use Illuminate\Http\Request;

class Cpc_company_contactController extends Controller
{
    // GET All Companies
    public function index()
    {
        $companies = Cpc_company_contact::all();
        return response()->json($companies);
    }

    // CREATE New Company
    public function store(Request $request)
    {
        $company = Cpc_company_contact::create($request->all());
        return response()->json($company);
    }

    // GET a Single Company
    public function show($id)
    {
        $company = Cpc_company_contact::find($id);
        return response()->json($company);
    }

    // UPDATE a Company
    public function update(Request $request, $id)
    {
        $company = Cpc_company_contact::find($id);
        $company->update($request->all());
        return response()->json($company);
    }

    // DELETE a Company
    public function destroy($id)
    {
        Cpc_company_contact::destroy($id);
        return response()->json('Company deleted');
    }
}
