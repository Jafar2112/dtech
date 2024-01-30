<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::acceptedWithRelations(['user', 'images', 'comments.user'])
            ->orderBy('id', 'desc')
            ->get();
        return view('home', compact('blogs'));
    }
}
