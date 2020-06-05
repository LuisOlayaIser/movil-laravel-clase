<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\estudiante::class, function (Faker $faker) {

    return [
        'nombre' => $faker->firstname,
        'apellido' => $faker->lastname,
        'telefono' => $faker->phonenumber,
        'email' => $faker->unique()->safeEmail,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\docente::class, function (Faker $faker) {

    return [
        'nombre' => $faker->firstname,
        'cargo' => $faker->randomElement(['Administrativo','Catedra','Ocacional','planta']),
        'email' => $faker->unique()->safeEmail,
        'telefono' => $faker->phonenumber,
        'apellido' => $faker->lastname,
        'imagen' => $faker->randomElement(['1.png','2.png','3.png','4.png']),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\materia::class, function (Faker $faker) {

    return [
        'nombre' => $faker->randomElement(['matematica','ingles','informatica','español','sociales','artistica']),
        'creditos' => $faker->numberBetween(1,4),
        'horas' => $faker->randomElement([2,3,4,5]),
        'descripcion' => $faker->paragraph(1),
        'docente_id' => App\docente::inRandomOrder()->first()->id,
    ];
});
