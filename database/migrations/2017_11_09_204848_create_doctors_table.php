<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id_doctor');
            $table->integer('specialty_id')->unsigned();
            $table->integer('job_id')->unsigned();            
            $table->bigInteger('dpi')->unsigned();
            $table->string('first_name', 50);
            $table->string('second_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->char('sex', 1);
            $table->string('mobile_number', 12);
            $table->string('email', 50);
            $table->integer('shift_id')->unsigned();
            $table->date('start_date')->nullable();
            $table->date('inactivity_date')->nullable();
            $table->decimal('salary', 12,2)->default(10000.00);
            $table->decimal('bonus', 12,2)->default(1000.00);         
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
        Schema::dropIfExists('doctors');
    }
}
