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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('storage_site_id')->nullable();
            $table->foreign('storage_site_id')->references('id')->on('storage_sites');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->unsignedBigInteger('exchange_by')->nullable();
            $table->foreign('exchange_by')->references('id')->on('users');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('users');
            $table->string('invoice_number')->nullable();
            $table->string('exchange_mode')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->date('exchange_date')->nullable();
            $table->double('total_percentage')->nullable();
            $table->double('total_tax')->nullable();
            $table->double('shipping_charges')->default(0);
            $table->string('discount_type')->nullable();
            $table->double('discount_percentage')->nullable();
            $table->double('discount')->nullable();
            $table->double('round_off')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('exchanges');
    }
};
