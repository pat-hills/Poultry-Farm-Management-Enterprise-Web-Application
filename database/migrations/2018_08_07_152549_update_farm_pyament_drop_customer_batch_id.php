<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFarmPyamentDropCustomerBatchId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farm_payments', function (Blueprint $table) {
            $table->dropForeign('farm_payments_batch_id_foreign');
            $table->dropForeign('farm_payments_customer_id_foreign');
            $table->dropForeign('farm_payments_vendor_id_foreign');
            $table->dropColumn('batch_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('vendor_id');

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
