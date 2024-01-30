<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $blogCount = Blog::count();
        $userCount = User::count();
        $waitingBlogsCount = Blog::waiting()->count();
        return view('admin.dashboard',compact(['userCount','blogCount','waitingBlogsCount']));
    }


}
