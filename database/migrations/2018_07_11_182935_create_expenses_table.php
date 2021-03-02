<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farm_id');
            //polymorphic relationship
            $table->unsignedInteger('expenditure_id');// the id of the kind of expense, eg. farm_feed, farm_drug
            $table->string('farm_drug_id');// expense type eg, FEED,DRUG etc
            $table->unsignedInteger('batch_id');
            $table->string('expense_item');
            $table->string('description');
            $table->string('amount_involved');
            $table->string('category');
            $table->unsignedInteger('created_by');
            // $table->foreign('farm_id')->references('id')->on('farm_account');
            // $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('farm_feed_id')->references('id')->on('farm_feed');
            // $table->foreign('farm_drug_id')->references('id')->on('farm_drug');
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
        Schema::dropIfExists('expenses');
    }
}
