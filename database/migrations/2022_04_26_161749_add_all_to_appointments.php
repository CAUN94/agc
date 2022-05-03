<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_mls', function (Blueprint $table) {
            $table->string('Estado')->after('id');
            $table->dateTime('Fecha')->after('Estado');
            $table->time('Hora_inicio')->after('Fecha');
            $table->time('Hora_termino')->after('Hora_inicio');
            $table->biginteger('Tratamiento_Nr')->after('Hora_termino');
            $table->string('Profesional')->after('Tratamiento_Nr');
            $table->string('Rut_Paciente')->after('Profesional');
            $table->string('Nombre_paciente')->after('Rut_Paciente');
            $table->string('Apellidos_paciente')->after('Nombre_paciente');
            $table->string('Mail')->after('Apellidos_paciente');
            $table->string('Celular')->after('Mail');
            $table->string('Convenio')->nullable($value = true)->after('Celular');
            $table->string('Sucursal')->after('Convenio');
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
            $table->dropColumn('Estado');
            $table->dropColumn('Fecha');
            $table->dropColumn('Hora_inicio');
            $table->dropColumn('Hora_termino');
            $table->dropColumn('Fecha');
            $table->dropColumn('Tratamiento_Nr');
            $table->dropColumn('Profesional');
            $table->dropColumn('Rut_Paciente');
            $table->dropColumn('Nombre_paciente');
            $table->dropColumn('Apellidos_paciente');
            $table->dropColumn('Mail');
            $table->dropColumn('Telefono');
            $table->dropColumn('Celular');
            $table->dropColumn('Convenio');
            $table->dropColumn('Convenio_Secundario');
            $table->dropColumn('Generación_Presupuesto');
            $table->dropColumn('Sucursal');
        });
    }
}
