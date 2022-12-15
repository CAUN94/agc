<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnsToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_mls', function (Blueprint $table) {
            $table->dateTime('Fecha_Atendiendose')->after('Fecha_Generación')->nullable();
            $table->dateTime('Fecha_Atendido')->after('Fecha_Atendiendose')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_mls', function (Blueprint $table) {
            $table->dropColumn('Fecha_Atendiendose');
            $table->dropColumn('Fecha_Atendido');
        });
    }
}
