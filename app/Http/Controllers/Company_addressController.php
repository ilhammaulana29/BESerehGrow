<?php

namespace App\Http\Controllers;

use App\Models\Company_address;
use Illuminate\Http\Request;

class Company_addressController extends Controller
{
    // GET All Companies
    public function index()
    {
        $address = Company_address::all();
        return response()->json($address);
    }

    // CREATE New Company
    public function store(Request $request)
    {
        $company = Company_address::create($request->all());
        return response()->json($company);
    }

    // GET a Single Company
    public function show($id)
    {
    $company = Company_address::find($id);
    return response()->json($company);
    }
    // UPDATE a Company
    public function update(Request $request, $id)
    {
        $company = Company_address::find($id);
        $company->update($request->all());
        return response()->json($company);
    }

    // DELETE a Company
    public function destroy($id)
    {
        Company_address::destroy($id);
        return response()->json('Company deleted');
    }
}
