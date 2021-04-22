<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('coaches', function(Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('fk_user');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('image_path', 200)->nullable();
            $table->enum('gender', array('male', 'female'))->nullable();
            $table->float('height')->default(0.00);
            $table->float('weight')->default(0.00);
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
        Schema::drop('coaches');
    }

}
