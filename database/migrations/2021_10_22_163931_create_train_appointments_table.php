<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->time('hour', $precision = 2);
            $table->integer('places')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(False);
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('trainer_id');
            $table->foreign('trainer_id')->references('id')->on('users');
            $table->foreign('training_id')->references('id')->on('trainings');
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
        Schema::dropIfExists('train_appointments');
    }
}
