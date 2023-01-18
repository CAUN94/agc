<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMutipleColumnsToNutrition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nutrition', function (Blueprint $table) {
            $table->float('biacromial')->after('talla_sentado')->default(1);
            $table->float('torax_t')->after('biacromial')->default(1);
            $table->float('torax_ap')->after('torax_t')->default(1);
            $table->float('torax_meso')->after('torax_ap')->default(1);
            $table->float('iliocrestideo')->after('torax_ap')->default(1);
            $table->float('humeral')->after('iliocrestideo')->default(1);
            $table->float('femoral')->after('humeral')->default(1);
            $table->float('cabeza')->after('femoral')->default(1);
            $table->float('brazo_r')->after('cabeza')->default(1);
            $table->float('brazo_flex')->after('brazo_r')->default(1);
            $table->float('antebrazo_max')->after('brazo_flex')->default(1);
            $table->float('cintura')->after('antebrazo_max')->default(1);
            $table->float('muslo_max')->after('cintura')->default(1);
            $table->float('pierna_cm')->after('muslo_max')->default(1);
            $table->float('pierna_mm')->after('pierna_cm')->default(1);
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
            $table->dropColumn('pierna');
            $table->dropColumn('bicep');
            $table->dropColumn('cresta_iliaca');
        });
    }
}
