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
        Schema::create('survey_submissions', function (Blueprint $table) {
            $table->id();

            // User info
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('telegram_phone');
            $table->string('telegram_username')->nullable();
            $table->string('email');
            $table->unsignedTinyInteger('number_rating');
            $table->text('message')->nullable();

            // File paths
            $table->string('personal_photo_path');
            $table->string('identification_document_path')->nullable();

            // Storage details
            $table->string('folder_name');

            // Metadata
            $table->string('ip_address', 45)->nullable(); // IPv4/IPv6
            $table->string('user_agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('locale')->nullable();

            // Timestamps
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_submissions');
    }
};
