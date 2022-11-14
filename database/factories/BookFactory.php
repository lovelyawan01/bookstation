<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
	$title = $faker->name;
    return [
        'category_id' =>$faker->numberBetween($min = 1, $max = 50)  ,
        'author_id' =>$faker->numberBetween($min = 1, $max = 50) ,
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'availability' => $faker->randomElement(['Yes', 'No']) ,
        'price'  =>$faker->numberBetween($min = 1000, $max = 9000),
        'rating' => $faker->randomElement(['1', '2','3','4','5']),
        'publisher' => $faker->randomElement(['Yes', 'No']) ,
        'country_of_publisher' => $faker->country,
        'isbn' => $faker->isbn10 ,
        'isbn-10' =>$faker->isbn10  ,
        'audience' => $faker->randomElement(['Yes', 'No']),
        'format' =>$faker->randomElement(['Yes', 'No']) ,
        'language' =>$faker->languageCode ,
        'total_pages' =>$faker->numberBetween($min = 1000, $max = 9000) ,
        'downloaded' => $faker->randomElement(['1', '2','3','4','5']),
        'edition_number' =>$faker->randomElement(['Yes', 'No']) ,
        'recommended' =>$faker->randomElement(['Yes', 'No']) ,
        'description' => $faker->text($maxNbChars = 500),
        'book_img' => 'No image found',
        'book_upload' => $faker->randomElement(['Yes', 'No']),
        'status' => $faker->randomElement(['DEACTIVE', 'ACTIVE'])
    ];
});
