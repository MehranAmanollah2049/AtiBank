<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['state_id','city_name_fa','city_name_en','city_name_ar'];

    protected $cascadeDeletes = ['jobs','users'];
    protected $dates = ['deleted_at'];

    // get state
    public function state() {

        return $this->belongsTo(State::class);
    }

    public function jobs() {

        return $this->hasMany(Job::class)->where("status" , "تایید شده");
    }

    // user
    public function users() {

        return $this->hasMany(User::class);
    }
    
}
