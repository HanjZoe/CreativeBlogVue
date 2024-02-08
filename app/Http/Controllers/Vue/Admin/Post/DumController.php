<?php

namespace App\Http\Controllers\Vue\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DumController extends Controller
{
    public function __invoke(Request $request)
    {
        dd($request);
    }
}
