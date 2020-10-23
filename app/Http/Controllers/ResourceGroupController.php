<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceGroup as RG;
use App\Http\Requests\ResourceGroupRequest as RGR;

class ResourceGroupController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'All resource groups retrieved',
            'data' => [
                'rgs' => RG::get(['id', 'name', 'image'])->toArray(),
            ],
        ]);
    }

    public function store(RGR $request)
    {
        RG::validate($request);
        RG::create(['name' => $request->name, 'description' => $request->description]);

        return response()->json([
            'success' => true,
            'message' => 'Resource Group successfully created'
        ], 201);
    }

    public function update(RGR $request, RG $group)
    {
        $group->update(['name' => $request->name, 'description' => $request->description]);

        return response()->json([
            'success' => true,
            'message' => 'Resource Group successfully updated'
        ]);
    }

    public function toggleStatus(RG $group)
    {
        $group->update(['is_active' => !$group->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Resource Group successfully ' . ($group->is_active ? 'deactivated' : 'activated')
        ]);
    }
}
