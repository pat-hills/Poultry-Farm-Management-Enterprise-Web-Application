<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFarmPayablePaymentsWithbatchid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
      Schema::table('farm_payable_payments', function (Blueprint $table) { 
        $table->unsignedinteger('batch_id')->nullable(); 
        $table->foreign('batch_id')->references('id')->on('stock_tracking');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
