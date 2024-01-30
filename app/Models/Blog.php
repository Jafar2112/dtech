<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function userId($id)
    {
        return Blog::where('user_id',$id);
    }
    public static function waiting()
    {
        return Blog::where('accepted',0);
    }

    public static function findOrFailWithUserCheck($id)
    {
        return Blog::where(['id'=>$id,'user_id'=>Auth::id()])->firstOrFail();
    }

    public static function acceptedWithRelations(array $relations)
    {
        return Blog::with($relations)->where('accepted',1);
    }

    public static function findOrFailWithUserCheckAndRelation($id,$relation)
    {
        return Blog::with($relation)->where(['id'=>$id,'user_id'=>Auth::id()])->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class,'blog_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'blog_id','id');
    }

}
