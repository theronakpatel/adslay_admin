<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeviceMedia;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceMediaController extends Controller
{
    public function showMedia($deviceId)
    {
        $device = Device::findOrFail($deviceId);
        $media = $device->media()->orderBy('position')->get();
        return view('admin.devices.media.index', compact('device', 'media'));
    }
    public function updateOrder(Request $request, $deviceId)
    {
        $order = $request->input('order');

        // Update the position for each media item
        foreach ($order as $position => $mediaId) {
            DeviceMedia::where('device_id', $deviceId)
                ->where('media_id', $mediaId)
                ->update(['position' => $position]);
        }

        return response()->json(['success' => true]);
    }

    public function updateRepeatCount(Request $request)
    {
        $mediaId = $request->input('media_id');
        $repeatCount = $request->input('repeat_count');

        // Update repeat count in the database
        $deviceMedia = DeviceMedia::where('id', $mediaId)->first();
        if ($deviceMedia) {
            $deviceMedia->repeat_count = $repeatCount;
            $deviceMedia->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Media not found'], 404);
    }
}
