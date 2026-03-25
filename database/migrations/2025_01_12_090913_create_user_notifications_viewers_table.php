<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_notification_viewers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned();
            $table->bigInteger('notification_id')->unsigned();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();

            $table->index('admin_id');
            $table->index('notification_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_notification_viewers');
    }
};
