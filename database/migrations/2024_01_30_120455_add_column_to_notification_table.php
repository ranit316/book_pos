<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
                $table->foreignId('publisher_id')->references('id')->on('publishers')->nullable();
                $table->string('message')->nullable();
                $table->timestamp('date_time')->nullable();
                $table->enum('is_read', ['read', 'unread'])->default('unread')->nullable();
               
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
};
