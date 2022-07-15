<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->string('plan');
            $table->float('peso');
            $table->float('talla_parado');
            $table->float('talla_sentado');
            $table->float('masa_adiposa');
            $table->float('indice_musculo');
            $table->float('masa_muscular');
            $table->float('indice_adiposo');
            $table->float('masa_osea');
            $table->float('indice_corporal');
            $table->float('tricep');
            $table->float('bicep');
            $table->float('muslo_medial');
            $table->float('supraespinal');
            $table->float('subescapular');
            $table->float('cresta_iliaca');
            $table->float('pierna');
            $table->float('abdominal');
            $table->string('rut');
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
        Schema::dropIfExists('nutrition');
    }
}
