<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedilinkColumnToTreatmentsMl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatment_mls', function (Blueprint $table) {
            $table->boolean('medilink')->after('Proxima_cita')->default(False);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TreatmentMl', function (Blueprint $table) {
            $table->dropColumn('medilink');
        });
    }
}
