<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Arr;
use Auth;
use DB;
use Illuminate\Http\Request;
use Log;
use Validator;

class PostController extends Controller
{
    public function list($allPosts)
    {
        $count = Post::where('parent_id', null)->count();
        if($count < 10){
            $count = 0;
        }
        $count -= 10;

        if($allPosts == "true"){
            return response()->json(["posts" => Post::where('parent_id', null)->with(['children', 'user:id,name,avatar'])->get(),
                                "count" => 0]);
        }
        return response()->json(["posts" => Post::where('parent_id', null)->limit(10)->with(['children', 'user:id,name,avatar'])->get(),
                                "count" => $count]);
    }
    public function show(Post $post)
    {
        return response()->json(["posts" => [$post->load(['children', 'user:id,name,avatar'])],
        "count" => 0]);
    }

    public function create(Request $request)
    {
        Log::info('message');
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if($validator->fails()){
            return "Message field is empty";
        }

            $post = new Post;
            Log::info(json_encode($post->id));
            $post->user()->associate(Auth::user());
            Log::info(json_encode($post->id));
            $post->content = $request["content"];
            $post->save();
            Log::info(json_encode($post->id));
            $id = $post->id;

            if(Arr::get($request, "parent", null)){
                $post->parent()->associate(Post::find($request["parent"]));
                Log::info(json_encode($post->id));
                $post->parent_id = $request["parent"];
            }

            $post->id = $id;
            $post->save();
            return 1;
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();
        if($user->can('destroy', $post)){
            DB::table('posts')->where('id', '=', $post->id)->delete();
        }
        return true;


    }
    public function getPostChildren($parent)
    {
        $children = Post::findOrFail($parent)->children()->with(['children', 'user:id,name,avatar'])->get();
        return response()->json($children);
    }
}
