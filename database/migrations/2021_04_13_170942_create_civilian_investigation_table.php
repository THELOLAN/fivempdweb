<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilianInvestigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civilian_investigation', function (Blueprint $table) {
            $table->id();
            $table->string('civilian_identifier');
            $table->unsignedBigInteger('investigation_id');

            //$table->foreign('civilian_identifier')->references('identifier')->on(''.config('database.connections.ingame.database').'.users')->cascadeOnDelete();
            $table->foreign('investigation_id')->references('id')->on('investigations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civilian_investigation');
    }
}
