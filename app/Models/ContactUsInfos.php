<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsInfos extends Model
{
    use HasFactory;
    protected $fillable = ['insta_name', 'insta_link' , 'email_name' , 'email_link' , 'telegram_name' , 'telegram_link' , 'phones' , 'address_fa' , 'address_en' , 'address_ar'];
}
