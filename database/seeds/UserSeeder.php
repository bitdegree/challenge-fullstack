<?php

use App\User;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $body = $client->get('https://randomuser.me/api?results=12')->getBody();
        $obj = json_decode($body, true);
        foreach ($obj['results'] as $user) {
            User::create([
                'name' => $user['name']['first'],
                'email' => $user['email'],
                'email_verified_at' => now(),
                'password' => $user['login']['sha256'], // password
                'remember_token' => Str::random(10),
                'avatar' => $user['picture']['medium']
            ]);
        }
    }
}
