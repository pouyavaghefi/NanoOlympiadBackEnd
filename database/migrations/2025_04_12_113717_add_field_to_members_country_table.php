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
        Schema::table('members_country', function (Blueprint $table) {
            $table->tinyInteger('members_page')->after('pinned')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members_country', function (Blueprint $table) {
            $table->dropColumn('members_page');
        });
    }
};
