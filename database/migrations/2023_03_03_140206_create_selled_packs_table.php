<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelledPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selled_packs', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->string('user_name');
            $table->integer('professional_id');
            $table->string('professional_name');
            $table->integer('pack_id');
            $table->string('pack_name');
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
        Schema::dropIfExists('selled_packs');
    }
}
