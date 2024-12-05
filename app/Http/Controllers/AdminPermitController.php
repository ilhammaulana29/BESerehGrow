<?php

namespace App\Http\Controllers;

use App\Models\AdminPermit;
use Illuminate\Http\Request;

class AdminPermitController extends Controller
{
    public function index()
    {
        $adminPermits = AdminPermit::all();
        return response()->json($adminPermits);
    }
}
