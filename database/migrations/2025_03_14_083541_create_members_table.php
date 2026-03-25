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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('surname')->nullable();
            $table->string('father_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('passport_number', 9)->nullable()->unique();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_code')->nullable();
            $table->string('passport_photo')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('referer_code')->nullable();
            $table->string('personal_code')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
