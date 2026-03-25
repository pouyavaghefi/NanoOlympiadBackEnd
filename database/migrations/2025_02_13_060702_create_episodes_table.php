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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->string('slug');
            $table->string('type');
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('video_url');
            $table->string('tags');
            $table->string('time',15)->default('00:00:00');
            $table->integer('number');
            $table->integer('view_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
