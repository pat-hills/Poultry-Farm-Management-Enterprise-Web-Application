<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmPayablePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_payable_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->unsignedInteger('farm_payable_id');
            $table->string('payment_code')->nullable();
            $table->unsignedInteger('vendor_id');
            $table->double('amount_paid',8,2);
            $table->string('receipt_number')->nullable();
            $table->date('date_paid')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('name_of_bank')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('description')->nullable();
            $table->date('date_on_cheque')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('operator_type')->nullable(); 
            $table->unsignedInteger('created_by'); 
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('farm_payable_id')->references('id')->on('farm_payable');
            // $table->foreign('vendor_id')->references('id')->on('vendor');
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
        Schema::dropIfExists('farm_payable_payments');
    }
}
