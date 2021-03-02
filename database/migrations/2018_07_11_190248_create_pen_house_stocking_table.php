<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenHouseStockingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pen_house_stocking', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('batch_id');
            $table->unsignedInteger('farm_payables_id');
            $table->string('number_of_stock');
            $table->string('type_of_bird');
            $table->unsignedInteger('pen_house_id');
            $table->string('penhouse_identity');
            $table->string('description')->nullable();
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('created_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('pen_house_id')->references('id')->on('pen_house');
            // $table->foreign('vendor_id')->references('id')->on('vendor');
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
        Schema::dropIfExists('pen_house_stocking');
    }
}
