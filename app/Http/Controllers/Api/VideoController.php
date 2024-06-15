<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
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
}