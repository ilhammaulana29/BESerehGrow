<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // GET All Companies
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    // CREATE New Company
    public function store(Request $request)
    {
        $company = Company::create($request->all());
        return response()->json($company);
    }

    // GET a Single Company
    public function show($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    // UPDATE a Company
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update($request->all());
        return response()->json($company);
    }

    // DELETE a Company
    public function destroy($id)
    {
        Company::destroy($id);
        return response()->json('Company deleted');
    }
}
