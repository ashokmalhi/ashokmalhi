<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPlayersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('team_players', function(Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('match_id');
            $table->integer('team_id');
            $table->integer('player_id');
            $table->integer('position');
            $table->boolean('is_manager')->default(0);
            $table->boolean('is_coach')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('team_players');
    }

}
