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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('volume')->default(0);
            $table -> enum('binding_type',['Hard Back','Paper Back','Hard Cover','Soft Cover','Soft','Hard'])->default('Soft');
            $table->string('edition')->nullable();
            $table->string('series')->nullable();
            $table->string('issue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('volume');
            $table->dropColumn('binding_type');
            $table->dropColumn('edition');
            $table->dropColumn('series');
            $table->dropColumn('issue');
        });
    }
};
