<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainAppointmentsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_appointments_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('train_appointment_id');
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
        Schema::dropIfExists('train_appointments_pivot');
    }
}
