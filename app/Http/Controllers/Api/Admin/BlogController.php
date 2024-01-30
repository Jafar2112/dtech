<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function waitingBlogs()
    {
        $blogs = Blog::waiting()->get();
        return response($blogs,200);
    }

    public function showBlog($id)
    {
        $blog = Blog::with(['images'])->findOrFail($id);
        return response($blog,200);
    }

    public function acceptBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update([
            'accepted' => 1,
        ]);
        return response($blog,200);
    }

    public function topBlogs()
    {
        $blogs =  Blog::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(5)
            ->get();

        return response($blogs,200);
    }


}
