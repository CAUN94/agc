<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestaSatisfaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta_satisfaccions', function (Blueprint $table) {
            $table->id();
            $table->string('rut');
            $table->string('pain');
            $table->string('satisfaction');
            $table->string('experience');
            $table->string('friend');
            $table->string('comment')->nullable();
            $table->string('gustos');
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
        Schema::dropIfExists('encuesta_satisfaccions');
    }
}
