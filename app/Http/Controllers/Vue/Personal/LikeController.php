<?php

namespace App\Http\Controllers\Vue\Personal;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->likedPosts;
        return response()->json($posts);

    }
    public function delete(Post $post){
        auth()->user()->likedPosts()->detach($post->id);
        return response([]);
    }
}
