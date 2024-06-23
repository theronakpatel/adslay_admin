<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceInfo;

class DeviceInfoController extends Controller
{
    public function index()
    {
        $deviceInfos = (new DeviceInfo)->newQuery();
        if (request()->has('search')) {
            $deviceInfos->where('device_id', 'Like', '%'.request()->input('search').'%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $deviceInfos->orderBy($attribute, $sort_order);
        } else {
            $deviceInfos->latest();
        }

        $deviceInfos = $deviceInfos->paginate(config('admin.paginate.per_page'))->onEachSide(config('admin.paginate.each_side'));


        return view('admin.device-info.index', compact('deviceInfos'));
    }
}
