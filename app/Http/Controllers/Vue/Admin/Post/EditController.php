<?php

namespace App\Http\Controllers\Vue\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class EditController extends BaseController
{
    public function __invoke(Post $post)
    {
        //return Post::with("tags","category","comments")->find($post->id);

        return response()->json(new PostResource(Post::with("tags","category","comments")->find($post->id)));
    }
}
