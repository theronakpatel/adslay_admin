<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceInfo;
use Illuminate\Http\Request;

class DeviceInfoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'device' => 'required|string',
            'buildId' => 'required|string',
            'board' => 'required|string',
            'brand' => 'required|string',
            'display' => 'required|string',
            'hardware' => 'required|string',
            'product' => 'required|string',
            'manufacturer' => 'required|string',
            'osVersion' => 'required|string',
            'device_id' => 'required|string|unique:device_infos,device_id',
        ]);

        $deviceInfo = DeviceInfo::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $deviceInfo
        ], 201);
    }
}
