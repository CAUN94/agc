<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pago');
            $table->integer('id_pagador');
            $table->integer('id_paciente');
            $table->string('nombre_paciente');
            $table->string('rut');
            $table->string('mediopago');
            $table->integer('folio');
            $table->string('tipo_documento');
            $table->integer('monto_pago');
            $table->integer('monto_boleta');
            $table->date('fecha_pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
