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
        Schema::create('topmenu_navigation_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_item_id');
            $table->string('language_code');
            $table->string('translate_name')->nullable();
            $table->string('translate_description')->nullable();
            $table->timestamps();

            $table->foreign('menu_item_id')->references('id')->on('topmenu_navigation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topmenu_navigation_translations');
    }
};
