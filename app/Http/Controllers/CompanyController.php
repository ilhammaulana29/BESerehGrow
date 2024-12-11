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
        $companies = Company::all()->map(function ($company) {
            return [
                'id_company' => $company->id_company,
                'nama_company' => $company->nama_company,
                'slogan' => $company->slogan,
                'logo_url' => $company->logo_url,
            ];
        });

        return response()->json($companies);
    }

    // CREATE New Company
    public function store(Request $request)
    {
        $request->validate([
            'nama_company' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'logo_company' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo_company')) {
            $file = $request->file('logo_company');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('logo', $filename, 'public'); // Save file with custom name
            $data['logo_company'] = $filename; // Save filename to DB
        }

        $company = Company::create($data);
        return response()->json($company);
    }

    // GET a Single Company
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        return response()->json([
            'id_company' => $company->id_company,
            'nama_company' => $company->nama_company,
            'slogan' => $company->slogan,
            'logo_company' => $company->logo_company,
        ]);
    }

    // UPDATE a Company
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_company' => 'required|string|max:255',
        'slogan' => 'nullable|string|max:255',
        'logo_company' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
    ]);

    try {
        $company = Company::findOrFail($id);
        
        // Update basic info
        $company->nama_company = $request->nama_company;
        $company->slogan = $request->slogan;

        // Handle logo upload if present
        if ($request->hasFile('logo_company')) {
            // Delete old logo if exists
            if ($company->logo_company) {
                Storage::disk('public')->delete('logo/' . $company->logo_company);
            }

            $file = $request->file('logo_company');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo', $filename, 'public');
            $company->logo_company = $filename;
        }

        $company->save();

        return response()->json([
            'message' => 'Company updated successfully',
            'data' => $company
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating company',
            'error' => $e->getMessage()
        ], 500);
    }
}


    // DELETE a Company
    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        // Delete associated file
        if ($company->logo_company) {
            Storage::disk('public')->delete('logo/' . $company->logo_company);
        }

        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
