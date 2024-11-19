<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->all();

        // Check if there's a file in the request
        if ($request->hasFile('logo_company')) {
            $file = $request->file('logo_company');                
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->store('logo', $filename, 'public'); // Save file in the 'logos' directory within the public storage
            $data['logo_company'] = $filename; // Store the file path in the data array
        }

        $company = Company::create($data);
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
        $data = $request->all();

        // Check if there's a new file in the request
        if ($request->hasFile('logo_company')) {
            // Delete the old file if it exists
            if ($company->logo_company) {
                Storage::disk('public')->delete($company->logo_company);
            }

            // Store the new file
            $file = $request->file('logo_company');
            $path = $file->store('logos', 'public');
            $data['logo_company'] = $path;
        }

        $company->update($data);
        return response()->json($company);
    }

    // DELETE a Company
    public function destroy($id)
    {
        $company = Company::find($id);

        // Delete the file associated with the company if it exists
        if ($company && $company->logo_company) {
            Storage::disk('public')->delete($company->logo_company);
        }

        $company->delete();
        return response()->json('Company deleted');
    }
}
