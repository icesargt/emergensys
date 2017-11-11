<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->integer('history_id')->unsigned();
            $table->integer('desease_id')->unsigned();
            $table->string('origin', 250)->nullable();
            $table->string('reason', 250)->nullable();
            $table->string('personal_history', 250)->nullable();
            $table->integer('sala')->unsigned()->nullable();
            $table->integer('bed')->unsigned()->nullable();
            $table->string('recet_detail', 250)->nullable();
            $table->string('day_week', 20)->nullable();
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
        Schema::dropIfExists('details');
    }
}
