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
            $table->dropColumn('ref_no');
            $table->dropColumn('status');
            $table->dropColumn('payaments_type');
            $table->dropColumn('payament_mode');
            $table->dropColumn('bank_name');
            $table->dropColumn('upi_no');
            //$table->enum('status',['success','pending','failed'])->nullable();
            $table->string('bank_id')->nullable()->after('status');
            $table->string('upi_id')->nullable()->after('card_no');
            //$table->enum('payament_mode',['online','offline'])->nullable();
            //$table->enum('payaments_type',['cash','netbanking','upi','card'])->nullable();
            $table->string('orderid')->nullable()->before('bank_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_payments', function (Blueprint $table) {
            //
        });
    }
};
