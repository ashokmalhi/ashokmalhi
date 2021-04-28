<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('matches', function(Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('name')->nullable();
            $table->integer('first_team');
            $table->integer('second_team');
            $table->dateTime('match_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('matches');
    }

}
