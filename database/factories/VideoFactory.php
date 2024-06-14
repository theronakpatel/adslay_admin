<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            's3_key' => 'videos/' . $this->faker->uuid . '.mp4',
            'cloudfront_url' => env('AWS_CLOUDFRONT_URL') . '/videos/' . $this->faker->uuid . '.mp4',
        ];
    }
}
