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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/*$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});*/


$factory->define(App\Model\Leitura::class, function (Faker\Generator $faker) {
	//protected $fillable = ['horario_leitura', 'valor_temperatura', 'valor_umidade', 'placa_id'];

    return [
        'horario_leitura' => $faker->dateTimeThisMonth($max = 'now', $timezone = date_default_timezone_get()),
        'valor_temperatura' => $faker->numberBetween($min = 10, $max = 40),
        'valor_umidade' => numberBetween($min = 20, $max = 100),
        'placa_id' => numberBetween($min = 1, $max = 4),
    ];
});