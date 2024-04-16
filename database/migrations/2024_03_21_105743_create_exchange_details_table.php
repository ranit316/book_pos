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
        Schema::create('exchange_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_id')->references('id')->on('exchanges');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('price')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('lot_number')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('tax_percentage')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('taxeble_amount')->nullable();
            $table->double('total_amount')->nullable();
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
        Schema::dropIfExists('exchange_details');
    }
};
