<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video as Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Media as Media1;

class MediaController extends Controller
{
    
    public function showUploadForm()
    {
        $this->authorize('adminCreate', Media1::class);
        return view('admin.upload');
    }

    public function store(Request $request)
    {
        $this->authorize('adminCreate', Media1::class);
        $file = $request->file('video');
        
        $request->validate([
            'title' => 'required|string|max:255'
        ]);
        
        if (!$request->hasFile('video')) {
            return redirect()->route('admin.media.index')->with('error', 'No video file was uploaded.');
        }

        $file = $request->file('video');
        
        if (!$file->isValid()) {
            return redirect()->route('admin.media.index')->with('error', 'The uploaded file is not valid.');
        }
        
        $fileName = time() . '_' . $file->getClientOriginalName();
        $s3Key = 'videos/' . $fileName;
        try {
            // Upload to S3 with public visibility
            $result = Storage::disk('s3')->putFileAs('videos', $file, $fileName, 'public');
            if (!$result) {
                
                return redirect()->route('admin.media.index')->with('error', 'Failed to upload the video to S3.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to upload the video to S3. Please check the logs for more details.');
        }

        // Get CloudFront URL
        $cloudfrontUrl = config('filesystems.disks.s3.cloudfront_url') . '/' . $s3Key;

        // Save video information to the database
        $video = new Media();
        $video->title = $request->title;
        $video->s3_key = $s3Key;
        $video->media_type = $request->media_type;
        $video->cloudfront_url = $cloudfrontUrl;
        $video->save();

        return redirect()->route('admin.media.index')->with('success', 'Video uploaded successfully');
    }

    public function index()
    {
        $this->authorize('adminViewAny', Media1::class);
        $mediaItems = (new Media)->newQuery();
        if (request()->has('search')) {
            $mediaItems->where('title', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $mediaItems->orderBy($attribute, $sort_order);
        } else {
            $mediaItems->latest();
        }

        $mediaItems = $mediaItems->paginate(config('admin.paginate.per_page'))->onEachSide(config('admin.paginate.each_side'));

        return view('admin.media.index', compact('mediaItems'));
    }

    public function create()
    {
        $this->authorize('adminCreate', Media1::class);
        return view('admin.media.create');
    }
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('s3')->delete($media->s3_key);
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully');
    }
}
