<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

const avatars = [
    'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/77/777be6c9c6476d30bfe505f80dfcb6832c8add6b_full.jpg',
    'https://i.pinimg.com/originals/e3/31/57/e33157ea21bd33ddea822beb78f6df16.jpg',
    'https://i1.wp.com/atechguides.com/wp-content/uploads/2018/11/steam-avatar-profile-picture-0236.jpg?fit=184%2C184&ssl=1',
    'https://pbs.twimg.com/media/CcDH-70UUAAClNF.jpg',
    'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/098c2f3a-7cf0-4148-8d59-e2795f5671db/d9hymog-64386ed4-3642-4710-b3bc-5852cb1eb11f.jpg/v1/fill/w_250,h_250,q_70,strp/faded_darkness_by_cyan_co_d9hymog-250t.jpg',
    'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/cb/cb4aa44730d856e1971a1be933f6e374f661f299_full.jpg',
    'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png'
];

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
        'avatarURL' => avatars[array_rand(avatars)],
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
