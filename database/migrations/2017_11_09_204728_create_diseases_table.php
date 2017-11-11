<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->increments('id_disease');
            $table->integer('level_id')->unsigned();
            $table->string('description', 100);
            $table->string('cause', 100);
            $table->string('first_sintom', 50);
            $table->string('second_sintom', 50);
            $table->string('third_sintom', 50);
            $table->date('day_detected')->nullable();
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
        Schema::dropIfExists('diseases');
    }
}
