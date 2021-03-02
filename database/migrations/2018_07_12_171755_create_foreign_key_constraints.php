<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('eggs_remaining_track', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');

        });

        Schema::table('farm_drugs_recording', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');

        });
        Schema::table('farm_drugs', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('users');

        });
        Schema::table('farm_feed', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('vendor');
        });
        Schema::table('farm_feed_recording', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');

        });

        Schema::table('farm_owings', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('sales_id')->references('id')->on('farm_sales');

        });
        Schema::table('farm_payments', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('sales_id')->references('id')->on('farm_sales');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
        });

        Schema::table('farm_payroll', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employee');

        });
        Schema::table('farm_sales', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customer');

        });

        Schema::table('subscription', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

        });
        Schema::table('subscription_payment', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('paid_by')->references('id')->on('users');

        });
        Schema::table('subscription_plan', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('account_category', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('asset', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });
        
        Schema::table('culling_dead_birds', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
        });
        Schema::table('customer', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });
        Schema::table('expenses', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
        });
        Schema::table('farm_eggs', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');

        });

        Schema::table('farm_payables', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->foreign('batch_id')->references('id')->on('stock_tracking'); 
        });

        Schema::table('farm_users', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('income', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
        });

        Schema::table('income_category', function (Blueprint $table) {

            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('login_logs', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::table('payables_category', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('pen_house', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');

        });

        Schema::table('pen_house_stocking', function (Blueprint $table) {

            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');
            $table->foreign('farm_payables_id')->references('id')->on('farm_payables');

        });

        Schema::table('sales_details', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('pen_house_id')->references('id')->on('pen_house');
            $table->foreign('sales_id')->references('id')->on('farm_sales');
            $table->foreign('batch_id')->references('id')->on('stock_tracking');

        });

        Schema::table('stock_tracking', function (Blueprint $table) {
            $table->foreign('farm_id')->references('id')->on('farm_account');
            $table->foreign('created_by')->references('id')->on('users');
            // $table->foreign('batch_id')->references('id')->on('stock_tracking');

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
