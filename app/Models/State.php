<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use  HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['country_id','state_name_fa','state_name_en','state_name_ar'];

    protected $cascadeDeletes = ['cities'];
    protected $dates = ['deleted_at'];

    // get country
    public function country() {

        return $this->belongsTo(Country::class);
    }

    // get cities
    public function cities() {

        return $this->hasMany(City::class);
    }
}
