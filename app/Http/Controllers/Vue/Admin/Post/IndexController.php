<?php

namespace App\Http\Controllers\Vue\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::all();
        $posts = Post::with("tags","category","comments")->get();
        //$posts = Post::with("category")->get();
        //$posts = Post::latest()->first();
        //dd($posts);
        $posts = PostResource::collection($posts);
        // dd(PostResource::collection($posts));
        //return new PostResource($posts);
        return response()->json($posts);
    }
}
