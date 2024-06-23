<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', 'device_name', 'added_date'
    ];

    public function media()
    {
        return $this->belongsToMany(Video::class, 'device_media', 'device_id', 'media_id')->withPivot('id','repeat_count', 'position');
    }
    
}
