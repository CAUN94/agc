<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGanateSesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganate_sesions', function (Blueprint $table) {
            $table->id();
            $table->string('mail');
            $table->boolean('services-radio');
            $table->text('services');
            $table->string('satisfaction');
            $table->text('servicesinterest');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('ganate_sesions');
    }
}
