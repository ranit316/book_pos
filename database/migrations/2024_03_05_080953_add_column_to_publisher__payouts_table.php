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
        Schema::table('publisher__payouts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('payaments_type');
            $table->dropColumn('payament_mode');
            $table->dropColumn('ref_no');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publisher__payouts', function (Blueprint $table) {
            //
        });
    }
};
