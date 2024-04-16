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
        Schema::table('sale_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('master_stock_inventeries_id')->nullable();
            $table->foreign('master_stock_inventeries_id')->references('id')->on('master_stock_inventeries');
            $table->string('lot_number')->nullable();
            $table->string('Purchase_price')->nullable();
            $table->string('qty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_price', function (Blueprint $table) {
            //
        });
    }
};
