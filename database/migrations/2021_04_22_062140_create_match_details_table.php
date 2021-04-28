<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('match_details', function(Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('match_id');
            $table->integer('player_id')->nullable();
            $table->integer('sensor')->nullable();
            $table->string('time_played')->nullable();
            $table->float('distance_km')->nullable();
            $table->float('hid_distance_15_km')->nullable();
            $table->float('distance_speed_range_15_km')->nullable();
            $table->float('distance_speed_range_15_20_km')->nullable();
            $table->float('distance_speed_range_20_25_km')->nullable();
            $table->float('distance_speed_range_25_30_km')->nullable();
            $table->float('distance_speed_range_greater_30_km')->nullable();
            $table->float('no_of_sprint_greater_25_km')->nullable();
            $table->float('avg_speed_km')->nullable();
            $table->float('max_speed_km')->nullable();
            $table->float('max_acceleration')->nullable();
            $table->float('no_of_acceleration_3')->nullable();
            $table->float('no_of_acceleration_4')->nullable();
            $table->float('no_of_deceleration_3')->nullable();
            $table->float('no_of_deceleration_4')->nullable();
            $table->boolean('is_summary')->default(0);
            $table->boolean('period')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('match_details');
    }

}
