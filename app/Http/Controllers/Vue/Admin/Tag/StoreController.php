<?php

namespace App\Http\Controllers\Vue\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vue\Admin\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Tag::firstOrCreate($data);
       return response([]);

    }
}
