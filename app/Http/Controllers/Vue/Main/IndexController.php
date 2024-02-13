<?php

namespace App\Http\Controllers\Vue\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends Controller
{
public function __invoke(Request $request)
{
   $post= PostResource::collection(Post::with("tags","category","comments","likedUsers")->paginate(6, ['*'], 'page', $request['page']));
    return $post;


}
public function user(){

    $posts = PostResource::collection(Post::with("tags","category","comments","likedUsers")->get());
    if(count($posts) > 4){
        $data['randomPosts'] =  PostResource::collection(Post::with("tags","category","comments","likedUsers")->get()->random(4));
    } else{
        $data['randomPosts'] = $posts;
    }
    $data['user'] = Auth::guard('api')->user();
    $data['categories'] = Category::all();
    $data['likedPost'] = PostResource::collection(Post::with("tags","category","comments","likedUsers")->withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4));
    return response()->json($data);
}
}
