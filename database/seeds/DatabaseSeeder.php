<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeeder extends Seeder
{
    use RefreshDatabase;

    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CommentSeeder::class);
    }
}
