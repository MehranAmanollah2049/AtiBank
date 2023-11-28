<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Answer extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['user_id_sender', 'user_id_receiver', 'comment_id', 'answer_text', 'status', 'type_sender', 'type_receiver','deleted_at'];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    // get comment
    public function comment()
    {

        return $this->belongsTo(Comment::class);
    }

    // get user sender
    public function user_sender()
    {

        return $this->belongsTo(User::class, 'user_id_sender');
    }

    // get user receiver
    public function user_receiver()
    {

        return $this->belongsTo(User::class, 'user_id_receiver');
    }


    public function likesNum() {

        return CommentLikes::where("comment_id" , $this->id)->where("comment_type" , 'answer')->where('like_type' , 'like')->get()->count();
    }

    public function unlikesNum() {

        return CommentLikes::where("comment_id" , $this->id)->where("comment_type" , 'answer')->where('like_type' , 'unlike')->get()->count();
    }
}
