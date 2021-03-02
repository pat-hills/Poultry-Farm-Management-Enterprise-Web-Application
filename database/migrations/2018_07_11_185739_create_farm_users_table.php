<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id'); 
            $table->string('fullname');
            $table->string('primary_contact');
            $table->string('pincode');
            $table->string('email');
            $table->string('region');
            $table->string('location');
            $table->string('gender');
            $table->string('position');
            $table->string('education');
            $table->unsignedInteger('created_by');
            $table->string('remember_token'); 
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('farm_users');
    }
}
