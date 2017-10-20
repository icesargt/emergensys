<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIgssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igsses', function (Blueprint $table) {
            $table->increments('id_igss');
            $table->smallInteger('year');
            $table->decimal('quota',5,2);
            $table->char('status',1)->default(1); // 1 = exist / 0 = deleted
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
        Schema::dropIfExists('igsses');
    }
}
