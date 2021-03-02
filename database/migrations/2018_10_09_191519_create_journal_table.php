<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {
           // $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->string('acc_name');
            $table->string('acc_type');
            $table->string('description')->nullable();
            $table->double('debit',8,2)->nullable();
            $table->double('credit',8,2)->nullable();
            $table->double('bal')->nullable();
            $table->unsignedInteger('created_by'); 
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('journal', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
          
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
        Schema::dropIfExists('journal');
    }
}
