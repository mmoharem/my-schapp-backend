<?php

use App\User;
use App\Models\StudTransaction;
use App\Models\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//$factory->define(User::class, function (Faker $faker) {
//    return [
//        'first_name' => $faker->lastName,
//        'last_name' => $faker->firstName,
//        'email' => $faker->unique()->safeEmail,
//        // 'email_verified_at' => now(),
//        // 'password' => 'secret', // password
//        'password' => bcrypt('secret'),
//        'remember_token' => Str::random(10),
//    ];
//});

$factory->define(StudTransaction::class, function(Faker $faker) {

    $student = Student::all()->random(mt_rand(1, 3));

    return [
        'type' => 'school_fees',
        'amount' => $faker->numberBetween(1000, 2000),
        'student_id' => Student::all()->random()->id,
    ];
});