<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $commentRequest, $id)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $id,
            'content' => $commentRequest['content'],
        ]);
        return back();
    }

}
