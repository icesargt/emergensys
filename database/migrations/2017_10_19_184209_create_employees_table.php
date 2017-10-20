<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id_employee');
            $table->string('name',50);
            $table->string('last_name',50);
            $table->date('start_date');
            $table->char('status',1)->default(1); // 1 = active / 0 = inactive / 2 = deleted
            $table->date('inactivity_date');
            $table->decimal('bonus',10,2);
            $table->decimal('isr',10,2);
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
        Schema::dropIfExists('employees');
    }
}
