<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchStatDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_stat_details', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('player_id');
            $table->string('time_played')->nullable();
            $table->float('x_position')->nullable();
            $table->float('y_position')->nullable();
            $table->float('lat')->nullable();
            $table->float('long')->nullable();
            $table->float('speed')->nullable();
            $table->float('hr')->nullable();
            $table->float('num_sat')->nullable();
            $table->float('h_dop')->nullable();
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
        Schema::dropIfExists('match_stat_details');
    }
}
