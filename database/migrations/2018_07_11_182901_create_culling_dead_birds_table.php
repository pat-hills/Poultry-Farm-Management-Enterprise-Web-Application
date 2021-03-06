<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCullingDeadBirdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culling_dead_birds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('batch_id');
            $table->string('number_of_birds');
            $table->string('reason');
            $table->unsignedInteger('pen_house_id');
            $table->unsignedInteger('created_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('pen_house_id')->references('id')->on('pen_house');
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
        Schema::dropIfExists('culling_dead_birds');
    }
}
