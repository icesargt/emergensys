<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id_patient');
            $table->bigInteger('dpi');
            $table->string('first_name', 50);
            $table->string('second_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->char('sex', 1);
            $table->string('mobile_number', 12);
            $table->string('email', 50);
            $table->string('social_security', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('address_birth', 200)->nullable();
            $table->string('photo', 250)->nullable();
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
        Schema::dropIfExists('patients');
    }
}
