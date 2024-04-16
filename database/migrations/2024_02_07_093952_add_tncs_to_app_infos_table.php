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
        Schema::table('app_infos', function (Blueprint $table) {
            $table->text('purchase_tnc')->nullable();
            $table->text('sale_tnc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_infos', function (Blueprint $table) {
            $table->dropColumn('purchase_tnc');
            $table->dropColumn('sale_tnc');
        });
    }
};
