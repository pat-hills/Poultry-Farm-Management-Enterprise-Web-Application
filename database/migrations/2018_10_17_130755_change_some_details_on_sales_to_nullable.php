<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSomeDetailsOnSalesToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_details', function (Blueprint $table) {
        
         
            $table->unsignedInteger('pen_house_id')->nullable()->change();
            $table->string('egg_type')->nullable()->change();
            $table->string('egg_size')->nullable()->change();
            $table->string('unit_measurement')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
