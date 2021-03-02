<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmOwingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_owings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('sales_id');
            $table->string('amount_due');
            $table->year('date_due');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('customer_id')->references('id')->on('customer');
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
        Schema::dropIfExists('farm_owings');
    }
}
