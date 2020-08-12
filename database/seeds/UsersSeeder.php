<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 8; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        foreach (User::all() as $user) {
            DB::table('posts')->insert(
                [
                    "user_id" => $user->id,
                    "content" => Str::random(30)
                ] );
        }

    }
}
