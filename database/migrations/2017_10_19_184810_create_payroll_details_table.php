<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payroll_id');
            $table->integer('employee_id');
            $table->integer('salary_id');
            $table->integer('igss_id');

            $table->decimal('ordinary_salary',12,2);
            $table->decimal('bonus',10,2);
            $table->decimal('total_salary',12,2);

            $table->decimal('isr_retention',10,2);
            $table->decimal('igss',10,2);
            $table->decimal('net_salary',12,2);            
            $table->char('status',1)->default(1); // 1 = exist / 0 = deleted by renglon         
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
        Schema::dropIfExists('payroll_details');
    }
}
