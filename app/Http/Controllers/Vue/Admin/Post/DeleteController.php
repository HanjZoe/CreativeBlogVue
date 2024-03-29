<?php

namespace App\Http\Controllers\Vue\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class DeleteController extends BaseController
{
    public function __invoke(Post $post)
    {
        $post->delete();
        return response([]);
    }
}
