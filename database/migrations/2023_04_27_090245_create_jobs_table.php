<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("cascade");
            $table->unsignedBigInteger("subcategory_id");
            $table->foreign("subcategory_id")->references("id")->on("subcategories")->onDelete("cascade");
            $table->string("job_name_fa");
            $table->string("job_name_en");
            $table->string("job_name_ar");
            $table->string("description_fa",1000);
            $table->string("description_en",1000);
            $table->string("description_ar",1000);
            $table->string("manager_name_fa");
            $table->string("manager_name_en");
            $table->string("manager_name_ar");
            $table->string("phoneNumber");
            $table->string("address_fa");
            $table->string("address_en");
            $table->string("address_ar");
            $table->string("longitude");
            $table->string("latitude");
            $table->string("saturday_time_work");
            $table->string("sunday_time_work");
            $table->string("monday_time_work");
            $table->string("tusday_time_work");
            $table->string("wednesday_time_work");
            $table->string("thursday_time_work");
            $table->string("friday_time_work");
            $table->string("banner");
            $table->string("instagram")->default('-');
            $table->string("telegram")->default('-');
            $table->string("email")->default('-');
            $table->string("website_url")->default('-');
            $table->string("status")->default("تایید نشده");
            $table->string("view")->default(0);
            $table->string("Rate")->default(0);
            $table->string("Rate_Num")->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
