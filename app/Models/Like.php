<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','job_id'];
    protected $table = 'job_user';

    public static function checkLike($job_id) {

        if(auth()->check()) {

            return Like::where('user_id' , auth()->user()->id)->where('job_id' , $job_id)->first();
        }
        else {

            return false;
        }
    }

    public static function like($job_id) {

        Like::create([
            "user_id" => auth()->user()->id,
            "job_id" => $job_id,
        ]);

        return true;

    }

    public static function unlike($job_id) {

        Like::where("user_id" , auth()->user()->id)->where("job_id" , $job_id)->delete();
        
        return true;

    }   
}
