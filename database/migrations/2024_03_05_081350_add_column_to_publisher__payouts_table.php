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
            $table->enum('status',['success','pending','failed'])->nullable();
            $table->enum('payament_mode',['online','offline'])->nullable();
            $table->enum('payaments_type',['cash','netbanking','upi','card'])->nullable();
            $table->string('txn_no')->nullable();
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
