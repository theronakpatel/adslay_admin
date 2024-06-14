<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'device',
        'buildId',
        'board',
        'brand',
        'display',
        'hardware',
        'product',
        'manufacturer',
        'osVersion',
        'device_id',
    ];
}
