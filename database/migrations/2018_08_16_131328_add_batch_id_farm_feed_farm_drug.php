<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchIdFarmFeedFarmDrug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('farm_feed_recording', function (Blueprint $table) {
            $table->unsignedInteger('batch_id')->nullable(); 
            $table->timestamp('date_recorded')->nullable();  
            $table->foreign('batch_id')->references('id')->on('stock_tracking'); 

        });

        Schema::table('farm_drugs_recording', function (Blueprint $table) {
            $table->unsignedInteger('batch_id')->nullable(); 
            $table->timestamp('date_recorded')->nullable(); 
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
