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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Use same ID as external API
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->nullable()->unique(); // optional contact
            $table->string('ip_address')->nullable(); // last login IP
            $table->string('user_agent')->nullable(); // browser info
            $table->timestamp('last_login_at')->nullable(); // last login time
            $table->boolean('is_active')->default(true); // if false, block login
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_tokens');
        Schema::dropIfExists('admins');
    }
};
