<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Author::class, function(Faker\Generator $faker)
{
	return [
		'name' => $faker->firstName
	];
});

$factory->define(App\Library::class, function(Faker\Generator $faker)
{
	return [
		'name' => $faker->firstName
	];
});

$factory->define(App\Book::class, function(Faker\Generator $faker)
{
	return [
		'name' => $faker->name,
		'isbn' => $faker->isbn13,
		'summary' => $faker->text,
		'author_id' => $faker->numberBetween(1, 10),
		'created_by' => $faker->numberBetween(1, 10)
	];
});