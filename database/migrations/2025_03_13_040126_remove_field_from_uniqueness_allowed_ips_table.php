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
        Schema::table('allowed_ip_exceptions', function (Blueprint $table) {
            $table->dropUnique('allowed_ip_exceptions_ip_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allowed_ip_exceptions', function (Blueprint $table) {
            $table->unique('ip');
        });
    }
};
