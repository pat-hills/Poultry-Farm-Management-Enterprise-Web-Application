<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFarmSalesAndDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bill_items', function (Blueprint $table) {
            $table->unsignedinteger('id')->nullable();
            $table->string('item_name');
            $table->unsignedInteger('farm_id');
            $table->string('expense_category')->nullable();
            $table->double('price', 8, 2);
            $table->string('description')->nullable();
            $table->string('item_type')->nullable();
            $table->string('weight')->nullable();
            $table->string('unit_of_measurement')->nullable();
            $table->unsignedinteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('farm_sales', function (Blueprint $table) {
            $table->string('invoice_number')->nullable();
            $table->timestamp('sales_date')->nullable();
            $table->timestamp('payment_due')->nullable();
        });

        Schema::table('sales_details', function (Blueprint $table) {
            $table->renameColumn('item_name', 'item_id');

        });
        Schema::table('sales_details', function (Blueprint $table) {
            $table->unsignedinteger('item_id')->change();
            $table->foreign('item_id')->references('id')->on('farm_items');
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
