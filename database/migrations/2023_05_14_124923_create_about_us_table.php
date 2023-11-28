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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string("content_fa" , 5000)->default('-');
            $table->string("content_en" , 5000)->default('-');
            $table->string("content_ar" , 5000)->default('-');
            $table->string("img")->default('-');
            $table->string("data_content_type");
            $table->string("type")->default('article');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
