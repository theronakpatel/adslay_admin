<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceInfo;

class DeviceInfoController extends Controller
{
    public function index()
    {
        $deviceInfos = DeviceInfo::all();
        return view('admin.device-info.index', compact('deviceInfos'));
    }
}
