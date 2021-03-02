<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FarmSaleChangeInvoiceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_sales', function (Blueprint $table) {
            $table->bigInteger('invoice_number')->nullable()->change(); 
        });
        Schema::table('farm_payments', function (Blueprint $table) {
            $table->bigInteger('receipt')->nullable()->change(); 
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
