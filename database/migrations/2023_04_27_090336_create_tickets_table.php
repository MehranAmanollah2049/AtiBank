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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("sender");
            $table->string("receiver");
            $table->string("ticket_text" , 2000)->nullable();
            $table->string("ticket_image" , 1000)->nullable();
            $table->string("sender_text");
            $table->string("receiver_text");
            $table->timestamp("seen")->nullable();
            $table->unsignedBigInteger("job_id");
            $table->foreign("job_id")->references("id")->on("jobs")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
