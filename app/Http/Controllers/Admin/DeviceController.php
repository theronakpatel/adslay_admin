<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Video;

class DeviceController extends Controller
{
    public function index()
    {
        $this->authorize('adminViewAny', Device::class);
        // $devices = Device::orderBy('created_at', 'desc')->get();
        $devices = (new Device)->newQuery();
        if (request()->has('search')) {
            $devices->where('device_id', 'Like', '%'.request()->input('search').'%');
        }
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $devices->orderBy($attribute, $sort_order);
        } else {
            $devices->latest();
        }

        $devices = $devices->paginate(config('admin.paginate.per_page'))->onEachSide(config('admin.paginate.each_side'));
        return view('admin.devices.index', compact('devices'));
    }

    public function create()
    {
        return view('admin.devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string|max:255|unique:devices',
            'device_name' => 'required|string|max:255',
        ]);

        Device::create([
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
            'added_date' => now(),
        ]);

        return redirect()->route('admin.devices.index')->with('success', 'Device added successfully');
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        return view('admin.devices.show', compact('device'));
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('admin.devices.edit', compact('device'));
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $request->validate([
            'device_id' => 'required|string|max:255|unique:devices,device_id,' . $device->id,
            'device_name' => 'required|string|max:255',
        ]);

        $device->update([
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
        ]);

        return redirect()->route('admin.devices.index')->with('success', 'Device updated successfully');
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('admin.devices.index')->with('success', 'Device deleted successfully');
    }

    public function editMedia($id)
    {
        $device = Device::findOrFail($id);
        $media = Video::all();
        $selectedMedia = $device->media->pluck('id')->toArray();
        return view('admin.devices.edit_media', compact('device', 'media', 'selectedMedia'));
    }

    public function updateMedia(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->media()->sync($request->media_ids);
        return redirect()->route('admin.devices.index')->with('success', 'Device media updated successfully');
    }

}
