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
use App\Models;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Models\Client::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'phone'    => $faker->phoneNumber,
        'email'    => $faker->email,
    ];
});

$factory->define(Models\Brend::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Models\Type::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
$factory->define(Models\Lmodel::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->word,
        'type_id'    => function() {
            return DB::table('types')->select('id')->inRandomOrder()->first()->id;
        },
        'brand_id'    => function() {
            return DB::table('brends')->select('id')->inRandomOrder()->first()->id;
        }
    ];
});
