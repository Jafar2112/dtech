<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Services\User\BlogService;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct()
    {
        $this->blogService = new BlogService();
    }

    public function index()
    {
        $blogs = Blog::acceptedWithRelations(['images', 'user', 'comments.user'])->get();
        return response($blogs, 200);
    }

    public function show($id)
    {
        $blog = Blog::with(['images', 'user', 'comments.user'])->findOrFail($id);
        return response($blog, 201);
    }

    public function store(BlogRequest $blogRequest)
    {
        $blog = null;
        DB::transaction(function () use ($blogRequest,&$blog) {
            $blog = Blog::create([
                'content' => $blogRequest['content'],
            ]);

            $images = request('images');

            foreach ($images as $image) {
                $this->blogService->storeImage($image);
                BlogImage::create([
                    'image' => $image,
                ]);
            }
        });
        return response($blog, 200);

    }

    public function update(BlogRequest $blogRequest, $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->update([
            'content' => $blogRequest['content'],
        ]);
        return response($blog, 201);
    }

    public function destroy($id)
    {
        Blog::destroy($id);
        BlogImage::where('blog_id', $id)->delete();
        Comment::where('blog_id', $id)->delete();

        return response('Deleted', 204);
    }
}
