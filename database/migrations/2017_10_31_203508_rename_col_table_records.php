<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColTableRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->renameColumn('bonus','bonus_rec');
            $table->renameColumn('isr','isr_rec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->renameColumn('bonus_rec','bonus')->nullable(true);
            $table->renameColumn('isr_rec','isr')->nullable(true);
        });
    }
}
