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
        Schema::create('pdf_requests', function (Blueprint $table) {
            $table->id();

            // User association (nullable for guest requests)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Request information
            $table->string('method', 10); // GET, POST, PUT, etc.
            $table->string('path');
            $table->string('full_url');
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            // Device detection
            $table->string('device_type')->nullable(); // desktop, mobile, tablet, robot
            $table->string('platform')->nullable(); // Windows, macOS, Linux, iOS, Android
            $table->string('browser')->nullable(); // Chrome, Safari, Firefox, etc.

            // Geolocation (if you want to add this later)
            $table->string('country_code', 2)->nullable();
            $table->string('country_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city_name')->nullable();

            // Request timing
            $table->timestamp('requested_at')->useCurrent();

            // Additional request data
            $table->json('headers')->nullable();
            $table->json('query_params')->nullable();
            $table->json('request_params')->nullable();

            // Response information
            $table->integer('status_code')->nullable();
            $table->integer('response_time_ms')->nullable();

            $table->timestamps();

            // Indexes for faster querying
            $table->index('user_id');
            $table->index('path');
            $table->index('method');
            $table->index('device_type');
            $table->index('requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_requests');
    }
};
