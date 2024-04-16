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
        Schema::create('publisher__payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->nullable()->references('id')->on('sales');
            $table->string('ref_no')->nullable();
            $table->enum('status', ['accept', 'reject', 'cancel'])->nullable()->default('accept');
            $table->string('bank_name')->nullable();
            $table->string('card_no')->nullable();
            $table->string('upi_no')->nullable();
            $table->double('amount');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->enum('payament_mode', ['Cash', 'Credit Card', 'Debit Card', 'Bank Transfer', 'Online Payments', 'UPI Payments', 'Cheques', 'Net Banking', ''])->nullable()->default('Online Payments');
            $table->string('payament_ss')->nullable();
            $table->string('payaments_type')->nullable()->comment('from_customer_to_customer');
            $table->string('remarks')->nullable();
            $table->foreignId('publisher_id')->nullable()->references('id')->on('publishers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publisher__payouts');
    }
};
