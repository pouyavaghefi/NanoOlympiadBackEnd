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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('image_cover')->after('image_url')->nullable();
            $table->integer('lectures')->after('image_cover')->nullable();
            $table->integer('quizzes')->after('lectures')->nullable();
            $table->string('language')->after('quizzes')->nullable();
            $table->string('skill_level')->after('language')->nullable();
            $table->boolean('certificate')->after('skill_level')->default(false);
            $table->text('assessments')->after('certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['image_cover','lectures', 'quizzes', 'language', 'skill_level', 'certificate', 'assessments']);
        });
    }
};
