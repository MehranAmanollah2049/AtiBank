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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id_sender");
            $table->unsignedBigInteger("user_id_receiver");
            $table->unsignedBigInteger("comment_id");
            $table->foreign("comment_id")->references("id")->on("comments")->onDelete("cascade");
            $table->string("answer_text");
            $table->string("status")->default("تایید نشده");
            $table->string("type_sender")->default("user");
            $table->string("type_receiver")->default("user");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
