<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;

class DeviceMediaController extends Controller
{
    public function getMediaByDeviceId($deviceId)
    {
        try {
            // Retrieve the device with media information
            $device = Device::findOrFail($deviceId);

            // Eager load media with pivot attributes 'repeat_count' and 'position'
            $media = $device->media()
                            ->withPivot('repeat_count', 'position')
                            ->orderBy('position')
                            ->get();

            // Return JSON response
            return response()->json([
                'device' => $device,
                'media' => $media,
            ]);

        } catch (\Exception $e) {
            // Handle exception (e.g., device not found)
            return response()->json(['error' => 'Device not found.'], 404);
        }
    }
}
