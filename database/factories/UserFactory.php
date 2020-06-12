<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'phone' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('0000'),
        'status' => 'active',
        'sex' => 'Мужской',
        'birth_day' => Carbon::create(1988, 9, 22),
        'age' => 33,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});
