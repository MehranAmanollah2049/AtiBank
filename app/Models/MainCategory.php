<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class MainCategory extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['category_name_fa','category_name_en','category_name_ar'];

    protected $cascadeDeletes = ['subcategories','advertising'];
    protected $dates = ['deleted_at'];

    // get subcategories
    public function subcategories() {

        return $this->hasMany(Subcategory::class , 'category_id');
    }

    // advertising
    public function advertising() {

        return $this->hasMany(Advertising::class , 'category_id');
    }
}
