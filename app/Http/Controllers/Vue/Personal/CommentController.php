<?php

namespace App\Http\Controllers\Vue\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Comment\UpdateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __invoke()
    {
        $comments = auth()->user()->comments;
        return response()->json($comments);
    }
    public function delete(Comment $comment){
        $comment->delete();
        return response([]);
    }
    public function update(UpdateRequest $request, Comment $comment){
        $data = $request->validated();
        $comment->update($data);
        return response([]);

    }
}
