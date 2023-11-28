<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Country extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['country_name_fa','country_name_en','country_name_ar' , 'country_code'];

    protected $cascadeDeletes = ['states'];
    protected $dates = ['deleted_at'];

    // get states
    public function states() {

        return $this->hasMany(State::class);
    }


}
