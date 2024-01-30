<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
        $users = User::all();
        return view('admin.users',compact('users'));
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $this->userService->blockUser($user);
        return back();
    }
}
