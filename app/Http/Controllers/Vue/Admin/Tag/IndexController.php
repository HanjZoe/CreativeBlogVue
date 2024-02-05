<?php

namespace App\Http\Controllers\Vue\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Tag::all();

        return response()->json($categories);
    }
}
