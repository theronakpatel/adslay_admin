<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        's3_key',
        'cloudfront_url',
        'media_type',
    ];
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'device_media', 'media_id', 'device_id');
    }
}
