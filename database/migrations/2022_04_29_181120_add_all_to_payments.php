<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_mls', function (Blueprint $table) {
            $table->integer('Atencion')->after('id');
            $table->string('Profesional')->nullable($value = true)->after('Atencion');
            $table->string('Especialidad')->after('Profesional');
            $table->integer('Pago_Nr')->after('Especialidad');
            $table->date('Fecha')->after('Pago_Nr');
            $table->string('Rut')->after('Fecha');
            $table->string('Nombre')->after('Rut');
            $table->string('Apellidos')->after('Nombre');
            $table->string('Tipo_Paciente')->nullable($value = true)->after('Apellidos');
            $table->string('Convenio')->nullable($value = true)->after('Tipo_Paciente');
            $table->string('Convenio_Secundario')->nullable($value = true)->after('Convenio');
            $table->integer('Boleta_Nr')->nullable($value = true)->after('Convenio_Secundario');
            $table->integer('Total')->after('Boleta_Nr');
            $table->integer('Asociado')->after('Total');
            $table->string('Medio')->after('Asociado');
            $table->string('Banco')->nullable($value = true)->after('Medio');
            $table->string('RutBanco')->nullable($value = true)->after('Banco');
            $table->string('Cheque')->nullable($value = true)->after('RutBanco');
            $table->dateTime('Vencimiento')->after('Cheque');
            $table->dateTime('Generado')->after('Vencimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_mls', function (Blueprint $table) {
            $table->dropColumn('Atencion');
            $table->dropColumn('Profesional');
            $table->dropColumn('Especialidad');
            $table->dropColumn('Pago_Nr');
            $table->dropColumn('Fecha');
            $table->dropColumn('Rut');
            $table->dropColumn('Nombre');
            $table->dropColumn('Apellidos');
            $table->dropColumn('Tipo_Paciente');
            $table->dropColumn('Convenio');
            $table->dropColumn('Convenio_Secundario');
            $table->dropColumn('Boleta_Nr');
            $table->dropColumn('Total');
            $table->dropColumn('Asociado');
            $table->dropColumn('Medio');
            $table->dropColumn('Banco');
            $table->dropColumn('RutBanco');
            $table->dropColumn('Cheque');
            $table->dropColumn('Vencimiento');
            $table->dropColumn('Generado');
        });
    }
}
