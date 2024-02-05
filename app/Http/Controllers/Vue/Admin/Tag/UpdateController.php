<?php

namespace App\Http\Controllers\Vue\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vue\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return response([]);
    }
}
