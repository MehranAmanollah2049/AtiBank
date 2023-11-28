<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class AboutUs extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['content_fa' , 'content_en' , 'content_ar' , 'img' , 'data_content_type' , 'type'];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];
}
