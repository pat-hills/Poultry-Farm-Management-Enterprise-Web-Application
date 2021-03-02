<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFarmPyamentMakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_payments', function (Blueprint $table) {
            $table->string('name_of_bank')->nullable()->change();
            $table->string('cheque_number')->nullable()->change();
            $table->string('cheque_date')->nullable()->change();
            $table->string('transaction_id')->nullable()->change();
            $table->string('operator_type')->nullable()->change();
            $table->string('description')->nullable()->change();

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
