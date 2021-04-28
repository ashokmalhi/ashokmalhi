<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches_details', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('player_id')->nullable();
            $table->string('time_played')->nullable();
            $table->string('player_position')->nullable();
            $table->float('distance_km')->nullable();
            $table->float('avg_speed_km')->nullable();
            $table->float('max_speed_km')->nullable();
            $table->float('max_acceleration')->nullable();
            $table->float('hid_distance_15_km')->nullable();
            
            $table->float('distance_speed_range_15_km')->nullable();
            $table->float('distance_speed_range_15_20_km')->nullable();
            $table->float('distance_speed_range_20_25_km')->nullable();
            $table->float('distance_speed_range_25_30_km')->nullable();
            $table->float('distance_speed_range_greater_30_km')->nullable();
            
            $table->float('no_of_sprint_greater_25_km')->nullable();
            
            $table->float('no_of_acceleration_1')->nullable();
            $table->float('acceleration_unit_1')->nullable();
            
            $table->float('no_of_acceleration_2')->nullable();
            $table->float('acceleration_unit_2')->nullable();
            
            $table->float('no_of_deceleration_1')->nullable();
            $table->float('deceleration_unit_1')->nullable();
            
            $table->float('no_of_deceleration_2')->nullable();
            $table->float('deceleration_unit_2')->nullable();
            
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
        Schema::dropIfExists('matches_details');
    }
}
