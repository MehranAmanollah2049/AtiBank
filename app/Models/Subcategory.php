<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Subcategory extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['category_id','subcategory_name_fa','subcategory_name_en','subcategory_name_ar'];

    protected $cascadeDeletes = ['jobs'];
    protected $dates = ['deleted_at'];

    // get category
    public function category() {

        return $this->belongsTo(MainCategory::class);
    }

    // cities
    public function jobs() {

        return $this->hasMany(Job::class)->where("status" , "تایید شده");
    }
}
