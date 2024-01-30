<?php

namespace App\Http\Services\Admin;

use App\Models\BlockedEmail;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function blockUser($user)
    {
        DB::transaction(function () use ($user) {

            BlockedEmail::create([
                'email' => $user->email,
            ]);

            $blogs = Blog::userId($user->id);
            foreach ($blogs->get() as $blog) {
                BlogImage::where('blog_id', $blog->id)->delete();
            }

            Comment::where('user_id', $user->id)->delete();
            $blogs->delete();
            $user->delete();
        });

    }
}
