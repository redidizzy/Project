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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $types = ['Entrepreneur', 'Client', 'Ouvrier'];//tableau contenant les types
    $typeRand = $types[rand(0,2)];//choix du type aleatoirement

    $type = factory('App\\'.$typeRand)->create();

    return [
        'nom' => $faker->name,
        'prenom' => $faker->firstName,
        'numTel' => $faker->phoneNumber,
        'wilaya' =>rand(1,48),
        'region' => $faker->city,
        'dateNaiss' => $faker->dateTime,
        'photoProfil' => config('images.path').'/default.png',
        'userable_id' => $type->id,
        'userable_type' => $typeRand,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define('App\Entrepreneur', function(Faker\Generator $faker){
	return [
		'experience' => rand(0,100),
		'disponibilite' => $faker->boolean,
		'materiel' => $faker->sentence,
		'reputation' => $faker->randomNumber()
	];
});
$factory->define('App\Client', function(Faker\Generator $faker){
	return[


	];
});
$factory->define('App\Ouvrier', function(Faker\Generator $faker){

    $fonction = factory('App\TypeOuvrier')->create();

	return[
		'diplome' => $faker->boolean,
		'experience' => rand(0,100),
		'reputation' =>$faker->randomNumber(),
		'fonction' => $fonction->designation,
		'prixApprox' => $faker->randomNumber()
	];
});
$factory->define('App\TypeOuvrier', function(Faker\Generator $faker){
    return[
        'designation' => $faker->unique()->word,
        'description' => $faker->paragraph
    ];

});
$factory->define('App\Projet', function(Faker\Generator $faker){
    $client = factory('App\Client')->create();
    $user = factory('App\User')->create(['userable_type' => 'Client', 'userable_id' => $client->id]);
    return [
        'client_id' => $client->id,
        'description' => $faker->paragraph,
        'superficie' => $faker->randomNumber() ,
        'wilaya' => $faker->randomNumber(),
        'budget' => $faker->randomNumber(),
        'delai' => $faker->sentence,
        'necessiteEntrepreneur' => $faker->boolean,
        'type_id' => $faker->randomNumber(),
        'region' => $faker->word
    ];
});