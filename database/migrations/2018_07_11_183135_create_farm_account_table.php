<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('farm_code');
            $table->unsignedInteger('parent_farm_id')->nullable();
            $table->string('farm_name');
            $table->string('country_code')->nullable();
            $table->string('farm_contact_one')->nullable();
            $table->string('farm_contact_two')->nullable();
            $table->string('farm_contact_one_intl')->nullable();
            $table->string('farm_contact_two_intl')->nullable();
            $table->string('bank')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('farm_address');
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->year('date_farm_established')->nullable();
            $table->string('farm_capacity');
            $table->unsignedInteger('created_by'); 
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
        Schema::dropIfExists('farm_account');
    }
}
