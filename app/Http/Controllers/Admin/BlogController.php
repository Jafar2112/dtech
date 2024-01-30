<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function waitingBlogs()
    {
        $blogs = Blog::waiting()->get();
        return view('admin.waiting-blogs',compact('blogs'));
    }

    public function showBlog($id)
    {
        $blog = Blog::with(['images'])->findOrFail($id);
        return view('admin.blog',compact('blog'));
    }

    public function acceptBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update([
            'accepted' => 1,
        ]);
        return redirect('/admin/waiting-blogs');
    }

    public function topBlogs()
    {
        $blogs =  Blog::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(5)
            ->get();

        return view('home',compact('blogs'));
    }


}
