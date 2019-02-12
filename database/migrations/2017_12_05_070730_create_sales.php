<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('sales_type_id');
//            $table->integer('item_id');
            $table->integer('payment_id');
            $table->decimal('total_amount', 7,2);
            $table->decimal('paid_amount', 7,2);
            $table->decimal('remaining_amount', 7,2)->default(0);
            $table->date('paid_date');
            $table->integer('sales_employee_id');
            $table->integer('user_id');
            $table->timestamps();
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
