<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStravaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strava_users', function (Blueprint $table) {
            $table->id();
            $table->string('strava_id')->nullable();
            $table->string('username')->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamp('token_expires')->nullable();
            $table->timestamp('activities_until')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('total_distance_meters')->default(0);
            $table->integer('total_distance_miles')->default(0);
            $table->integer('total_moving_time')->default(0);
            $table->string('total_moving_time_hum')->default('0 seconds');
            $table->integer('total_activities')->default(0);
            $table->integer('walk_count')->default(0);
            $table->integer('run_count')->default(0);
            $table->integer('max_speed')->default(0);
            $table->string('profile_link')->nullable();
            $table->timestamp('last_took_lead')->nullable();
            $table->boolean('is_in_lead')->default(false);
            $table->integer('time_in_lead')->default(0);
            $table->string('time_in_lead_hum')->default('0 seconds');
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
        Schema::dropIfExists('strava_users');
    }
}
