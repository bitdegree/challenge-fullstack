<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use GuzzleHttp\Client;
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
    $client = new Client();
    $body = $client->get('https://randomuser.me/api/')->getBody();
    $obj = json_decode($body);
    return [
        'name' => $obj->results[0]->name->first,
        'email' => $obj->results[0]->email,
        'email_verified_at' => now(),
        'password' => $obj->results[0]->login->sha256, // password
        'remember_token' => Str::random(10),
        'avatar' => $obj->results[0]->picture->medium
    ];
});
