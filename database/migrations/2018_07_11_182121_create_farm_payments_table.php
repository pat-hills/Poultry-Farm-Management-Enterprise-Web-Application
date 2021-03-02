<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('batch_id');
            $table->double('amount',8,2);
            $table->string('receipt');
            $table->string('description');
            $table->string('mode_of_payment');
            $table->string('name_of_bank');
            $table->string('cheque_number');
            $table->year('cheque_date');
            $table->string('transaction_id');
            $table->string('operator_type');
            $table->unsignedInteger('vendor_id'); 
            $table->unsignedInteger('created_by'); 
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('vendor_id')->references('id')->on('vendor');
            // $table->foreign('customer_id')->references('id')->on('customer'); 
            // $table->foreign('sales_id')->references('id')->on('farm_sales'); 
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
        Schema::dropIfExists('farm_payments');
    }
}
