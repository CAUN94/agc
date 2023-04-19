<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionSports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition_sports', function (Blueprint $table) {
            $table->id();
            $table->string('gender', 1);
            $table->string('descripcion');
            $table->float('endo');
            $table->float('meso');
            $table->float('ecto');
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
        Schema::dropIfExists('nutrition_sports');
    }
}
