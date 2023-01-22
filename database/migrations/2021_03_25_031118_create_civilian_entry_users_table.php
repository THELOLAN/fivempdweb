<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilianEntryUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civilian_entry_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('civilian_entry_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('civilian_entry_id')->references('id')->on('civilian_entries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('civilian_entry_users');
    }
}
