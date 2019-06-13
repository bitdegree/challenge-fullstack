<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 50)->create();
        factory(App\Comment::class, 200)->create()->each(
            function($comment) {
                $parent_id = random_int(1, 50);

                $comment->parent_id = $parent_id;
                $comment->save();

                $parentComment = App\Comment::find($parent_id);
                $parentComment->num_replies++;
                $parentComment->save();
            }
        );
    }
}
