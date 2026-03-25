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
        // Step 1: Replace NULL values with fallback before altering schema
        DB::table('members')
            ->whereNull('passport_number')
            ->update(['passport_number' => 'UNKNOWN']);

        // Step 2: Alter column to VARCHAR(20) NOT NULL
        Schema::table('members', function (Blueprint $table) {
            $table->string('passport_number', 20)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally revert to longer column or allow NULLs again
        Schema::table('members', function (Blueprint $table) {
            $table->string('passport_number', 255)->nullable()->change();
        });
    }
};