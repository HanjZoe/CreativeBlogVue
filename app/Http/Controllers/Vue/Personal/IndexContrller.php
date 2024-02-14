<?php

namespace App\Http\Controllers\Vue\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexContrller extends Controller
{
    public function __invoke()
    {
        $data = [];
        $data["comments"] = auth()->user()->comments->count();
        $data["posts"] = auth()->user()->likedPosts->count();
        return response()->json($data);
    }
}
