<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('players', function(Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('fk_user')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('player_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('image_path', 200)->nullable();
            $table->enum('gender', array('male', 'female'))->nullable();
            $table->float('height')->nullable()->default(0.00);
            $table->float('weight')->nullable()->default(0.00);
            $table->float('max_heart_rate')->nullable()->default(0.00);
            $table->float('target_heart_rate')->nullable()->default(0.00);
            $table->float('max_speed')->nullable()->default(0.00);
            $table->boolean('track_heart_rate')->nullable()->default(0);
            $table->string('sensor_no')->nullable();
            $table->string('position')->nullable();
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
        Schema::drop('players');
    }

}
