<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
	$title = $faker->name;
    return [
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'media_type'=> $faker->randomElement(['gallery', 'slideshow']),
        'media_img' => 'No image found',
        'description' => $faker->text($maxNbChars = 500),
         'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE'])
    ];
});
