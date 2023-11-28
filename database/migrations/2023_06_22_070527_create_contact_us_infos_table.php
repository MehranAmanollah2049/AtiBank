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
        Schema::create('contact_us_infos', function (Blueprint $table) {
            $table->id();
            $table->string('insta_name')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('email_name')->nullable();
            $table->string('email_link')->nullable();
            $table->string('telegram_name')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('phones')->nullable();
            $table->string('address_fa')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_infos');
    }
};
