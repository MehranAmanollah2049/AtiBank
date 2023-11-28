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
        Schema::create('job_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("job_id");
            $table->foreign("job_id")->references("id")->on("jobs")->onDelete("cascade");
            $table->string("image");
            $table->string("description_fa");
            $table->string("description_en");
            $table->string("description_ar");
            $table->string("status")->default("تایید نشده");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_galleries');
    }
};
