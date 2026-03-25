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
            $table->renameColumn('assessments', 'requirements');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('assessments')->default(0)->nullable()->after('requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('assessments');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('requirements', 'assessments');
        });


    }
};
