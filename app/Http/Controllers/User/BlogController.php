<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Services\Admin\UserService;
use App\Http\Services\User\BlogService;
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct()
    {
        $this->blogService = new BlogService();
    }

    protected const VIEW = 'user.blog.';

    public function contentCreate()
    {
        return view(self::VIEW . 'content-create');
    }

    public function contentStore(BlogRequest $blogRequest)
    {
        $blog = Blog::create([
            'content' => $blogRequest['content'],
            'user_id' => Auth::id(),
        ]);
        return redirect(route('blog.image_create', $blog->id));
    }

    public function contentEdit($id)
    {
        $blog = Blog::findOrFailWithUserCheck($id);
        return view(self::VIEW.'content-edit',compact('blog'));
    }

    public function contentUpdate(BlogRequest $blogRequest, $id)
    {
        $blog = Blog::findOrFailWithUserCheck($id);
        $blog->update([
            'content' => $blogRequest['content'],
        ]);
        return redirect(route('blog.image_create', $blog->id));
    }

    public function imageCreate($id)
    {
        $blog = Blog::findOrFailWithUserCheckAndRelation($id,'images');

        return view(self::VIEW.'image-create',compact('blog'));
    }

    public function imageStore(ImageRequest $imageRequest, $id)
    {

        $imageName = $this->blogService->storeImage($imageRequest['image']);
        $blog = Blog::findOrFail($id);

        BlogImage::create([
            'image' => $imageName,
            'blog_id' => $blog->id,
            'user_id' => $blog->user_id,
        ]);

        return back();
    }

}
