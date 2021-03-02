<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->unsignedInteger('farm_id');
            $table->string('expense_category')->nullable();
            $table->double('price',8,2);
            $table->string('description')->nullable();
            $table->string('item_type')->nullable();
            $table->string('weight')->nullable();
            $table->string('unit_of_measurement')->nullable(); 
            $table->unsignedInteger('created_by'); 
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('farm_id')->references('id')->on('farm_account');
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
        Schema::dropIfExists('farm_items');
    }
}
