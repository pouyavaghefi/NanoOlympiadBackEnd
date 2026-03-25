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
        Schema::create('base_infos', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100)->nullable();
            $table->string('value', 100)->nullable();
            $table->integer('grand_parent_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->boolean('can_user_edit')->default(0);
            $table->string('extra_value', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_infos');
    }
};
