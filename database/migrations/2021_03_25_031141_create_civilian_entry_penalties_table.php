<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilianEntryPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civilian_entry_penalties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('civilian_entry_id');
            $table->unsignedBigInteger('penalty_id');

            $table->foreign('civilian_entry_id')->references('id')->on('civilian_entries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('penalty_id')->references('id')->on('penalties')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civilian_entry_penalties');
    }
}
