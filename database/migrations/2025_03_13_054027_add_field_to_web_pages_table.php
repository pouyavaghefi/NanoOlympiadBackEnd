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
        Schema::table('web_pages', function (Blueprint $table) {
            $table->enum('type',['static','dynamic'])->after('content')->default('dynamic');
            $table->tinyInteger('editable')->after('type')->default(0);
            $table->tinyInteger('status')->after('editable')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_pages', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('editable');
            $table->dropColumn('status');
        });
    }
};
