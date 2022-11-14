<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    $title = $faker->name;
    return [
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'designation' => $faker->jobTitle,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'country' => $faker->country, 
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'description' => $faker->text($maxNbChars = 500),
        'author_feature' => $faker->randomElement(['yes', 'no']),
        'facebook_id' => $faker->unique()->safeEmail,
        'twitter_id' => $faker->unique()->safeEmail,
        'youtube_id' => $faker->unique()->safeEmail,
        'pinterest_id' => $faker->unique()->safeEmail,
        'author_img' => 'No image found',
        'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE'])
    ];
});
