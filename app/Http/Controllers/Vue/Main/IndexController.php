<?php

namespace App\Http\Controllers\Vue\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $post = PostResource::collection(Post::with("tags", "category", "comments", "likedUsers")->paginate(6, ['*'], 'page', $request['page']));
        return $post;


    }

    public function user()
    {

        $posts = PostResource::collection(Post::with("tags", "category", "comments", "likedUsers")->get());
        if (count($posts) > 4) {
            $data['randomPosts'] = PostResource::collection(Post::with("tags", "category", "comments", "likedUsers")->get()->random(4));
        } else {
            $data['randomPosts'] = $posts;
        }
        $data['user'] = Auth::guard('api')->user();
        $data['categories'] = Category::all();
        $data['likedPost'] = PostResource::collection(Post::with("tags", "category", "comments", "likedUsers")->withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4));
        return response()->json($data);
    }

    public function categry(Category $category)
    {
        $post = PostResource::collection($category->posts()->paginate(6));
        return $post;
    }
    public function like(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return response([]);
    }
    public function show(Post $post){
        $data['day'] = Carbon::parse($post->created_at)->day;
        $data['mouth'] = Carbon::parse($post->created_at)->translatedFormat('F');
        $data['year'] = Carbon::parse($post->created_at)->year;
        $data['time'] = Carbon::parse($post->created_at)->format('H:i');
        $data['relatedPosts'] = PostResource::collection(Post::where('category_id',$post->category_id)
            ->where('id','!=',$post->id)
            ->with("category", "comments", "likedUsers")
            ->get()
            ->take(3));
        $data['post'] = new PostResource($post);
        $data['user'] = Auth::guard('api')->user();
        return response()->json($data);
    }
    public function comment(Post $post, StoreRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        Comment::create($data);
        return response([]);
    }
}
