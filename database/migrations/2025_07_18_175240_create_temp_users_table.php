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
        Schema::create('temp_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->enum('activation_type',['no_activation','activation_sent','manual_activation'])->default('no_activation');
            $table->tinyInteger('user_status')->default(0);
            $table->unsignedBigInteger('submitted_by')->nullable();
            $table->string('token')->nullable();
            $table->string('password')->nullable();
            $table->string('password_hashed')->nullable();
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('submitted_at');
            $table->tinyInteger('confirmed_by_admin')->default(0);
            $table->timestamp('confirmed_by_admin_at')->nullable();
            $table->tinyInteger('confirmed_by_user')->default(1);
            $table->timestamp('confirmed_by_user_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('submitted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_users');
    }
};
