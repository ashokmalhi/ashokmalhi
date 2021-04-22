<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_user')->nullable();
            $table->integer('player_no')->nullable();
            $table->float('height')->default(0);
            $table->float('weight')->default(0);
            $table->float('max_heart_rate')->default(0);
            $table->float('target_heart_rate')->default(0);
            $table->float('max_speed')->default(0);
            $table->boolean('track_heart_rate')->default(false);
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
        Schema::dropIfExists('players');
    }
}
