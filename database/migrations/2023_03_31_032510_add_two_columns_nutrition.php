<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnsNutrition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('nutrition', function (Blueprint $table) {
          $table->float('muslo_medio')->after('muslo_max')->default(1);
          $table->float('cadera')->after('cintura')->default(1);
          $table->float('biceps')->after('subescapular')->default(1);
          $table->string('gender')->after('rut');
          $table->string('deporte')->after('gender');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
