<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndDropGanate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ganate_sesions', function (Blueprint $table) {
            $table->dropColumn(['mail']);
        });

        Schema::table('ganate_sesions', function (Blueprint $table) {
            $table->string('rut')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ganate_sesions', function (Blueprint $table) {
            $table->dropColumn('rut');
        });
    }
}
