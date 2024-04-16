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
        $table->foreignId('user_id')->nullable()->references('id')->on('users');
        $table->enum('payament_mode', ['Cash','Credit Card','Debit Card','Bank Transfer','Online Payments','UPI Payments','Cheques','Net Banking',''])->nullable()->default('Online Payments');
        $table->string('payament_ss')->nullable();
        $table->string('payaments_type')->nullable()->comment('from_customer_to_customer');
        $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_payaments', function (Blueprint $table) {
            //
        });
    }
};
