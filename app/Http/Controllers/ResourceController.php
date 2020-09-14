<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceGroup as RG;
use App\Resource as Re;
use App\Http\Requests\ResourceRequest as RR;

class ResourceController extends Controller
{
    public function index(RG $group)
    {
        return response()->json([
            'success' => true,
            'message' => 'All resource groups retrieved',
            'data' => [
                'group' => $group,
                'resources' => $group->resources,
            ],
        ]);
    }
}
