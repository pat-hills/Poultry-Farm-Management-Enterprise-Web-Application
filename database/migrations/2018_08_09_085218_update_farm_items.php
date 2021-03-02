<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFarmItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_items', function (Blueprint $table) {
            $table->string('item_category')->nullable();
            $table->string('drug_category')->nullable();
            $table->string('feed_category')->nullable();
            $table->string('active', 50)->nullable();
            $table->dropColumn('item_type');
        });
        Schema::table('farm_sales', function (Blueprint $table) {
            $table->string('status',50)->nullable();            
        });
        Schema::table('bill_items', function (Blueprint $table) {
            $table->string('active',50)->nullable();            
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
