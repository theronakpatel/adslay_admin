<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $file = $request->file('video');
        $filePath = $file->getRealPath();
        $fileName = time() . '_' . $file->getClientOriginalName();
        $s3Key = 'videos/' . $fileName;

        // Upload to S3
        $s3 = Storage::disk('s3')->put($s3Key, file_get_contents($file), 'public');

        // Get CloudFront URL
        $cloudfrontUrl = config('filesystems.disks.s3.cloudfront_url') . '/' . $s3Key;

        // Save video information to the database
        $video = new Video();
        $video->title = $request->title;
        $video->s3_key = $s3Key;
        $video->media_type = $request->media_type;
        $video->cloudfront_url = $cloudfrontUrl;
        $video->save();

        return response()->json(['message' => 'Video uploaded successfully', 'video' => $video], 201);
    }

    public function index()
    {
        $videos = Video::select('title', 'cloudfront_url')->get();
        // 's3_key',

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }
    public function getVideos($deviceId)
    {
        try {
            // Retrieve the device with media information
            $device = Device::where('device_id', $deviceId)->firstOrFail();
            
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