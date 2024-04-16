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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->references('id')->on('purchases');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('price')->nullable();
            $table->double('purchase_price')->nullable();
            $table->double('sale_price')->nullable();
            $table->string('batch_no')->nullable();
            $table->integer('request_qty');
            $table->integer('dispatch_qty')->nullable();
            $table->double('cgst')->nullable();
            $table->double('sgst')->nullable();
            $table->double('igst')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('taxeble_amount')->nullable();
            $table->double('total_amount')->nullable();
            $table->timestamps();  // by this method create two columns created_at and updated_at
            $table->softDeletes();
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
};
