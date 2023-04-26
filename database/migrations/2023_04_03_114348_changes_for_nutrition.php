<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesForNutrition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('nutrition', function (Blueprint $table) {
        $table->float('masa_piel')->after('masa_osea')->default(1);
        $table->float('masa_residual')->after('masa_piel')->default(1);
        $table->float('peso_estructurado')->after('indice_corporal')->default(1);
        $table->float('endo')->after('peso_estructurado')->default(1);
        $table->float('meso')->after('endo')->default(1);
        $table->float('ecto')->after('meso')->default(1);
        $table->string('habito')->after('gender');
        $table->integer('edad')->after('rut')->default(1);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('nutrition', function (Blueprint $table) {
        $table->dropColumn('masa_adiposa_porc');
        $table->dropColumn('masa_muscular_porc');
        $table->dropColumn('masa_osea_porc');
      });
    }
}
