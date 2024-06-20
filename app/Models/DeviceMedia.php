<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMedia extends Model
{
    protected $table = 'device_media';

    protected $fillable = [
        'device_id', 'media_id', 'position', 'repeat_count'
    ];
}
