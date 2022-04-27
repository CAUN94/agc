<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllToActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_mls', function (Blueprint $table) {
            $table->string('Sucursal')->after('id');
            $table->string('Nombre')->after('Sucursal');
            $table->string('Apellido')->after('Nombre');
            $table->integer('Categoria_Nr')->after('Apellido');
            $table->string('Categoria_Nombre')->after('Categoria_Nr');
            $table->integer('Tratamiento_Nr')->after('Categoria_Nombre');
            $table->string('Profesional')->nullable($value = true)->after('Tratamiento_Nr');
            $table->string('Estado')->nullable($value = true)->after('Profesional');
            $table->string('Convenio')->after('Estado');
            $table->integer('Prestacion_Nr')->after('Convenio');
            $table->string('Prestacion_Nombre')->after('Prestacion_Nr');
            $table->dateTime('Fecha_Realizacion')->after('Prestacion_Nombre');
            $table->integer('Precio_Prestacion')->after('Fecha_Realizacion');
            $table->integer('Abono')->after('Precio_Prestacion');
            $table->integer('Total')->after('Abono');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_mls', function (Blueprint $table) {
            $table->dropColumn('Sucursal');
            $table->dropColumn('Nombre');
            $table->dropColumn('Apellido');
            $table->dropColumn('Categoria_Nr');
            $table->dropColumn('Categoria_Nombre');
            $table->dropColumn('Tratamiento_Nr');
            $table->dropColumn('Profesional');
            $table->dropColumn('Estado');
            $table->dropColumn('Convenio');
            $table->dropColumn('Prestacion_Nr');
            $table->dropColumn('Prestacion_Nombre');
            $table->dropColumn('Fecha_Realizacion');
            $table->dropColumn('Precio_Prestacion');
            $table->dropColumn('Abono');
            $table->dropColumn('Total');
        });
    }
}
