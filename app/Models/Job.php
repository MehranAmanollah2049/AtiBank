<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Job extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['city_id','subcategory_id','job_name_fa','job_name_en','job_name_ar','description_fa','description_en','description_ar','manager_name_fa','manager_name_en','manager_name_ar','phoneNumber','address_fa','address_en','address_ar','longitude','latitude','saturday_time_work','sunday_time_work','monday_time_work','tusday_time_work','wednesday_time_work','thursday_time_work','friday_time_work','instagram','telegram','email','website_url','status','banner','view','Rate_Num','Rate','deleted_at'];

    protected $cascadeDeletes = ['comments','galley'];
    protected $dates = ['deleted_at'];

    // get user
    public function user() {

        return $this->belongsTo(User::class , 'phoneNumber', 'phoneNumber');
    }

    // get comments
    public function comments() {

        return $this->hasMany(Comment::class);
    }

    // get likes
    public function likes() {

        return $this->belongsToMany(User::class);
    }

    // get city
    public function city() {

        return $this->belongsTo(City::class);
    }

    // get subcaterories
    public function subcategory() {

        return $this->belongsTo(Subcategory::class);
    }

    // get job's gallery image
    public function galley() {

        return $this->hasMany(JobGallery::class);
    }

    // rates
    public function rates() {

        return $this->Rate;
    }

    public function GetRates() {

        return Rate::where("job_id" , $this->id)->get();
    }


    public function getCommentsNum($job_id) {

        $commentNum = 0;

        $comments = Job::where('id' , $job_id)->first()->comments()->where('status', 'تایید شده')->get();
        $commentNum += $comments->count();

        foreach ($comments as $cmt) {

            $commentNum += $cmt->answers()->where('status', 'تایید شده')->get()->count();
        }

        return $commentNum;
    }
}
