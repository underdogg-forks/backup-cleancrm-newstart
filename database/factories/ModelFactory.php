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
$factory->define(Modules\Core\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Modules\Hrm\Models\Employee::class, function (Faker\Generator $faker) {

    static $password;
    $faker->addProvider(new Faker\Provider\nl_NL\Person($faker));
    $faker->addProvider(new Faker\Provider\kk_KZ\Company($faker));


    //'gender' => $faker->randomElement($array = array ('male', 'female')) ,
    $gender = $faker->randomElements(['male', 'female']);

    return [
        'relation_id' => '0',
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'bsn' => $faker->idNumber,
        'idnr' => $faker->businessIdentificationNumber,
    ];
});