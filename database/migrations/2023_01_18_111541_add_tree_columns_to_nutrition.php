<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTreeColumnsToNutrition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nutrition', function (Blueprint $table) {
            $table->float('masa_adiposa_porc')->after('masa_adiposa')->default(1);
            $table->float('masa_muscular_porc')->after('masa_muscular')->default(1);
            $table->float('masa_osea_porc')->after('masa_osea')->default(1);
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
        });
    }
}
