<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmWastage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_wastage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('batch_id');
            $table->unsignedInteger('pen_house_id');
            $table->string('feed_name');
            $table->string('weight');
            $table->string('unit_measurement');
            $table->text('notes')->nullable();
            $table->timestamp('date_recorded')->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_wastage');
    }
}
