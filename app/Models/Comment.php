<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function authUser($id)
    {
        return Comment::where(['user_id'=>Auth::id(),'id'=>$id]);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
}
