<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherTwoColumnsToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_mls', function (Blueprint $table) {
            $table->dateTime('En_sala_de_espera')->after('Fecha_Atendido')->nullable();
            $table->dateTime('No_confirmado')->after('En_sala_de_espera')->nullable();
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
            $table->dropColumn('En_sala_de_espera');
            $table->dropColumn('No_confirmado');
        });
    }
}
