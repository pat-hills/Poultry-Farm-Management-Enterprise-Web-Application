<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('batch_id');
            $table->string('quantity');
            $table->string('amount');
            $table->string('total_amount');
            $table->string('item_name');
            $table->unsignedInteger('pen_house_id');
            $table->string('egg_type');
            $table->string('egg_size');
            $table->string('unit_measurement');
            $table->unsignedInteger('created_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('pen_house_id')->references('id')->on('pen_house');
            // $table->foreign('sales_id')->references('id')->on('farm_sales');
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
        Schema::dropIfExists('sales_details');
    }
}
