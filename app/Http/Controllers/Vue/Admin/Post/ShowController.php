<?php

namespace App\Http\Controllers\Vue\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        return view('Admin.Post.Show',compact('post'));
    }
}
