<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','comment_id','comment_type','like_type','type_user'];

}
