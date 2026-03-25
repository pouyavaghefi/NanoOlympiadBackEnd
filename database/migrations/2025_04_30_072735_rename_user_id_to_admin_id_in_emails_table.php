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
        Schema::table('emails', function (Blueprint $table) {
            $table->renameColumn('user_id', 'admin_id');
            $table->dropForeign(['user_id']);
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->renameColumn('admin_id', 'user_id');
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');
            $table->dropSoftDeletes();
        });
    }
};
