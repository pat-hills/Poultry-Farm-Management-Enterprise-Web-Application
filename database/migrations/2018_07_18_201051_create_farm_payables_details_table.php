<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmPayablesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_payables_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("farm_payables_id");
            $table->unsignedInteger("item_id");
            $table->string("quantity");
            $table->double("price",8,2);
            $table->double("total_amount",8,2); 
            $table->unsignedInteger("created_by");
            $table->foreign('farm_payables_id')->references('id')->on('farm_payables');
            $table->foreign('item_id')->references('id')->on('farm_items');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
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
        Schema::dropIfExists('farm_payables_details');
    }
}
