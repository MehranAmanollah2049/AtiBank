<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['name', 'family', 'username', 'password', 'phoneNumber'];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    public static function hasLikedComment($comment_id, $comment_type)
    {


        $result = CommentLikes::where("user_id", session('admin'))->where("type_user", "admin")->where("comment_id", $comment_id)->where("comment_type", $comment_type)->where('like_type', 'like')->get();


        if ($result->count() == 0) {

            return false;
        } else {

            return true;
        }
    }

    public static function hasUnLikedComment($comment_id, $comment_type)
    {


        $result = CommentLikes::where("user_id", session('admin'))->where("type_user", "admin")->where("comment_id", $comment_id)->where("comment_type", $comment_type)->where('like_type', 'unlike')->get();

        if ($result->count() == 0) {

            return false;
        } else {

            return true;
        }
    }
}
