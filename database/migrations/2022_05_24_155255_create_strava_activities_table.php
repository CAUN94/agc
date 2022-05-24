<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStravaActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strava_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('strava_id')->nullable();
            $table->string('name')->nullable();
            $table->float('distance')->nullable();
            $table->float('moving_time')->nullable();
            $table->float('elapsed_time')->nullable();
            $table->float('total_elevation_gain')->nullable();
            $table->string('type')->nullable();
            $table->string('start_date')->nullable();
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
        Schema::dropIfExists('strava_activities');
    }
}
