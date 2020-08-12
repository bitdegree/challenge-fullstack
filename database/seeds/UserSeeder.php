<?php

use App\Post;
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
        for ($i=0; $i < 30; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }

        foreach (User::all() as $user) {
            DB::table('posts')->insert(
                [
                    "user_id" => $user->id,
                    "content" => Str::random(30),
                    'created_at' => date("Y-m-d H:i:s")
                ] );
        }
        foreach (Post::all() as $post) {
            DB::table('posts')->insert(
                [
                    "user_id" => $user->id,
                    "content" => Str::random(30),
                    "parent_id" => $post->id,
                    'created_at' => date("Y-m-d H:i:s")
                ] );
        }
    }
}
