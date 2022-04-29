<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllToTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatment_mls', function (Blueprint $table) {
            $table->integer('Ficha')->nullable($value = true)->after('id');
            $table->string('Nombre')->after('Ficha');
            $table->string('Apellidos')->after('Nombre');
            $table->string('Atencion')->after('Apellidos');
            $table->string('Profesional')->nullable($value = true)->after('Atencion');
            $table->integer('TotalAtencion')->after('Profesional');
            $table->integer('TotalLaboratorios')->after('TotalAtencion');
            $table->integer('TotalRealizado')->after('TotalLaboratorios');
            $table->integer('TotalAbonado')->after('TotalRealizado');
            $table->integer('Avance')->after('TotalAbonado');
            $table->integer('Global')->after('Avance');
            $table->date('Proxima_cita')->nullable($value = true)->after('Global');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatment_mls', function (Blueprint $table) {
            $table->dropColumn('Ficha');
            $table->dropColumn('Nombre');
            $table->dropColumn('Apellidos');
            $table->dropColumn('Atencion');
            $table->dropColumn('Profesional');
            $table->dropColumn('TotalAtencion');
            $table->dropColumn('TotalLaboratorios');
            $table->dropColumn('TotalRealizado');
            $table->dropColumn('TotalAbonado');
            $table->dropColumn('Avance');
            $table->dropColumn('Global');
            $table->dropColumn('Proxima_cita');
        });
    }
}
