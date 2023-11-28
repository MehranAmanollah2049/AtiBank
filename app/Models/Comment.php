<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['user_id','job_id','comment_text','status','deleted_at'];

    protected $cascadeDeletes = ['answers'];
    protected $dates = ['deleted_at'];

    // get user
    public function user() {

        return $this->belongsTo(User::class);
    }

    // get job
    public function job() {

        return $this->belongsTo(Job::class);
    }

    // get answers
    public function answers() {

        return $this->hasMany(Answer::class);
    }


    public function likesNum() {

        return CommentLikes::where("comment_id" , $this->id)->where("comment_type" , 'comment')->where('like_type' , 'like')->get()->count();
    }

    public function unlikesNum() {

        return CommentLikes::where("comment_id" , $this->id)->where("comment_type" , 'comment')->where('like_type' , 'unlike')->get()->count();
    }
}
