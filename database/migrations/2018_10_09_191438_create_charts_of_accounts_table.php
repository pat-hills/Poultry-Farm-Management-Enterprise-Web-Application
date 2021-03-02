<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartsOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts_of_accounts', function (Blueprint $table) {
           // $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->string('item_name')->nullable();
            $table->string('acc_name');
            $table->string('acc_type');
            $table->string('sub_category')->nullable();
            $table->unsignedInteger('created_by'); 
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('charts_of_accounts', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
           // $table->foreign('item_name')->references('acc_name')->on('journal');
            $table->foreign('created_by')->references('id')->on('users');
           

        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charts_of_accounts');
    }
}
