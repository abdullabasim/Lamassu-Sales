<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreareReminder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('project_manager', function($table)
        {
            $table->increments('id');
            $table->string('full_name');
            $table->string('company_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('project_type_id');
            $table->string('project_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('email')->nullable();
            $table->text('note');
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
