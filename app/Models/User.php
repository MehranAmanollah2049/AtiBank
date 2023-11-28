<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes,CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'phone_code',
        'phoneNumber',
        'city_id',
        'password',
        'profile',
    ];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function city() {

        return $this->belongsTo(City::class);
    }

    // get jobs
    public function jobs()
    {

        return $this->hasMany(Job::class , 'phoneNumber' , 'phoneNumber');

    }

    // get advertising
    public function advertising()
    {

        return $this->hasMany(Advertising::class, 'user_id')->where("uploader_type", "user");
    }

    // get contact
    public function contacts()
    {

        return $this->hasMany(Contact::class, 'phoneNumber', 'phoneNumber');
    }

    // commments
    public function comments()
    {

        return $this->hasMany(Comment::class);
    }

    // answers
    public function answersSender()
    {

        return $this->hasMany(Answer::class, 'user_id_sender')->where("type_sender", "user");
    }

    // answers
    public function answersGetter()
    {

        return $this->hasMany(Answer::class, 'user_id_receiver')->where("type_receiver", "user");
    }

    // get likes
    public function likes()
    {

        return $this->belongsToMany(Job::class)->where("status" , "تایید شده");
    }

    // tickets
    public function ticketsSender()
    {

        return $this->hasMany(Ticket::class, 'sender')->where("sender_text", "user");
    }

    // tickets
    public function ticketsGetter()
    {

        return $this->hasMany(Ticket::class, 'receiver')->where("receiver_text", "user");
    }

    // rates
    public function rates()
    {

        return $this->belongsToMany(Job::class, 'rates');
    }

    public function GetRates()
    {

        return Rate::where("user_id", $this->id)->get();
    }

    public function hasLikedComment($comment_id, $comment_type)
    {


        $result = CommentLikes::where("user_id", auth()->user()->id)->where("type_user", "user")->where("comment_id", $comment_id)->where("comment_type", $comment_type)->where('like_type', 'like')->get();


        if ($result->count() == 0) {

            return false;
        } else {

            return true;
        }
    }

    public function hasUnLikedComment($comment_id, $comment_type)
    {


        $result = CommentLikes::where("user_id", auth()->user()->id)->where("type_user", "user")->where("comment_id", $comment_id)->where("comment_type", $comment_type)->where('like_type', 'unlike')->get();

        if ($result->count() == 0) {

            return false;
        } else {

            return true;
        }
    }
}
