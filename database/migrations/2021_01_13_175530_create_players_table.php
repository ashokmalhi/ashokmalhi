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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('player_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('image_path', 200)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->float('height')->default(0);
            $table->float('weight')->default(0);
            $table->float('max_heart_rate')->default(0);
            $table->float('target_heart_rate')->default(0);
            $table->float('max_speed')->default(0);
            $table->boolean('track_heart_rate')->default(false);
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
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
