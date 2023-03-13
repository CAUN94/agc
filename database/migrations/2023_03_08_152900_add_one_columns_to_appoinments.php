<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOneColumnsToAppoinments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_mls', function (Blueprint $table) {
            //ispay
            //paymend_id
            $table->boolean('ispay')->default(false)->after('Tratamiento_Nr');
            $table->string('payment_id')->nullable()->after('ispay');

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
            //drop
            $table->dropColumn('ispay');
            $table->dropColumn('payment_id');
        });
    }
}
