<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistancePerZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distance_per_zones', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('team_id');
            $table->integer('player_id');
            $table->float('distance_zone_a1')->nullable();
            $table->float('distance_zone_a2')->nullable();
            $table->float('distance_zone_b1')->nullable();
            $table->float('distance_zone_b2')->nullable();
            $table->float('distance_zone_c1')->nullable();
            $table->float('distance_zone_c2')->nullable();
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
        Schema::dropIfExists('distance_per_zones');
    }
}
