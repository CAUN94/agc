<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mls', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Apellidos');
            $table->string('Fecha_Ingreso');
            $table->string('Ultima_Cita')->nullable();
            $table->string('RUT');
            $table->string('Nacimiento')->nullable();
            $table->string('Celular')->nullable();
            $table->string('Ciudad')->nullable();
            $table->string('Comuna')->nullable();
            $table->string('Direccion')->nullable();
            $table->string('Email');
            $table->string('Observaciones')->nullable();
            $table->string('Sexo');
            $table->string('Convenio')->nullable();
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
        Schema::dropIfExists('user_mls');
    }
}
