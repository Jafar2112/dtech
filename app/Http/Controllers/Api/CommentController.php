<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response($comments, 200);
    }

    public function store(CommentRequest $commentRequest, $id)
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $id,
            'content' => $commentRequest['content'],
        ]);
        return response($comment, 201);
    }

    public function update(CommentRequest $commentRequest, $id)
    {
        $comment = Comment::authUser($id)->firstOrFail();

        $comment->update([
            'content' => $commentRequest['content'],
        ]);
    }

    public function destroy($id)
    {
        Comment::authUser($id)->firstOrFail()->delete();
        return response('Deleted', 204);
    }
}
