<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Worker;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Worker::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    //$date = [];
    //for ($i = 3; $i < 11; $i++){
       $date =
       [
           'user_id' => $faker->unique()->numberBetween(1, 12),
           'name' => User::where('id', $faker->unique()->numberBetween(1, 12))->first()->name,
           'surname' => User::where('id', $faker->unique()->numberBetween(1, 12))->first()->surname,
           'sex' => User::where('id', $faker->unique()->numberBetween(1, 12))->first()->sex,
           'age' => User::where('id', $faker->unique()->numberBetween(1, 12))->first()->age,
           'city'=> $faker->city,
           'about_me' => $faker->realText(200, 2),
           'draft' => 0,
           'tasks_completed' => 0,
           'rating' => 0,
           'created_at' => $createdAt,
           'updated_at' => $createdAt,

        ];
    //}
    return $date;
});
