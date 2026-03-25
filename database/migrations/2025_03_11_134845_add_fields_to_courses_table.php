<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('intro_video')->after('image_cover')->nullable();
            $table->string('intro_video_url')->after('image_cover')->nullable();
            $table->unsignedBigInteger('teacher_id')->after('intro_video_url')->nullable();

            // $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // $table->dropForeign(['teacher_id']);
            $table->dropColumn('intro_video');
            $table->dropColumn('intro_video_url');
            $table->dropColumn('teacher_id');
        });
    }

};
