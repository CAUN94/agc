<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEvolutionColumnToActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_mls', function (Blueprint $table) {
            $table->string('Evolution')->nullable()->after('Tratamiento_Nr');
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
            $table->dropColumn('Evolution');
        });
    }
}
