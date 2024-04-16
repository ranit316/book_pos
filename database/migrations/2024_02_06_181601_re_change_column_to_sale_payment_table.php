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
        Schema::table('sale_payaments', function (Blueprint $table) {
        $table->enum('payament_mode', ['Cash', 'Credit Card', 'Debit Card', 'Bank Transfer', 'Online Payments', 'UPI Payments', 'Cheques', 'Net Banking'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(' sale_payaments', function (Blueprint $table) {
            //
        });
    }
};
