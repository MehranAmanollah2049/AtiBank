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
        Schema::create('advertisings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("banner");
            $table->string("title_fa");
            $table->string("title_en");
            $table->string("title_ar");
            $table->string("link");
            $table->string("status")->default("تایید نشده");
            $table->string("payment_status")->default("پرداخت نشده");
            $table->string("price")->default("-");
            $table->string("uploader_type")->default("user");
            $table->timestamp('created_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string("date_end_days");
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("main_categories")->onDelete("cascade");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisings');
    }
};
