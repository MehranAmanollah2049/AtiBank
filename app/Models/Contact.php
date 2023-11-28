<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes,CascadeSoftDeletes;
    protected $fillable = ['name','family' ,'email','phoneNumber','text'];

    protected $cascadeDeletes = [];
    protected $dates = ['deleted_at'];

    // get user
    public function user() {

        return $this->belongsTo(User::class , 'phoneNumber' , 'phoneNumber');
    }
}
