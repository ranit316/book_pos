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
        Schema::table('pniv_details', function (Blueprint $table) {
            $table->foreignId('pniv_id')->nullable()->references('id')->on('pnivs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pniv_details', function (Blueprint $table) {
            //
        });
    }
};
