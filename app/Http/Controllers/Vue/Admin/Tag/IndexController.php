<?php

namespace App\Http\Controllers\Vue\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $tags = TagResource::collection(Tag::all());
        return response()->json($tags);
    }
}
