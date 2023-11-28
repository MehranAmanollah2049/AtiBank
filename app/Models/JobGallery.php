<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class JobGallery extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['job_id','image' , 'description_fa' , 'description_en' , 'description_ar' , 'status'];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    // get job
    public function job() {

        return $this->belongsTo(Job::class)->where("status" , "تایید شده");
    }
}
