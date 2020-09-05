<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceGroup as RG;

class ResourceGroupController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'All resource groups retrieved',
            'data' => RG::all()->pluck('name')->toArray(),
        ]);
    }
}
