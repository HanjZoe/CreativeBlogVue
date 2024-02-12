<?php

namespace App\Http\Controllers\Vue\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends Controller
{
public function __invoke()
{

   /* $posts = Post::with("tags","category","comments","likedUsers")->get();
    $posts = PostResource::collection($posts);
    return response()->json($posts);*/
    $user = Auth::guard('api')->user();
    return response()->json($user);
}
}
