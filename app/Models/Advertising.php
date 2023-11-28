<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Advertising extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['user_id', 'banner', 'title_fa', 'title_en' , 'title_ar', 'link', 'status', 'payment_status','created_at' , 'expired_at', 'uploader_type','price' , 'category_id' , 'date_end_days'];
    public $timestamps = false;

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    // get user
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    // category
    public function category() {

        return $this->belongsTo(MainCategory::class);
    }

}
