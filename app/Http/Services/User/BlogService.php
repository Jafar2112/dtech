<?php

namespace App\Http\Services\User;

use App\Models\BlogImage;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    public function storeImage($image)
    {
        $imageName = rand(0, 1000000) . '_' . rand(0, 1000000). '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/blog-images'), $imageName);
        return $imageName;
    }
}
