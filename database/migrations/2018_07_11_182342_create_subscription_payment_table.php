<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            $table->string('subscription_plan');
            $table->double('amount_paid',8, 2);
            $table->string('mode_of_payment');
            $table->year('payment_date');
            $table->string('transaction_id');
            $table->year('start_date');
            $table->year('end_date');
            $table->unsignedInteger('paid_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('paid_by')->references('id')->on('users');
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
        Schema::dropIfExists('subscription_payment');
    }
}
