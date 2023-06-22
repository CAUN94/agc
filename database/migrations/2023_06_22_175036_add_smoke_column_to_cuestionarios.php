<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSmokeColumnToCuestionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuestionarios', function (Blueprint $table) {
            // after P21 create P22
            $table->string('P22')->nullable()->after('P21');
            $table->string('P23')->nullable()->after('P22');
            $table->string('P24')->nullable()->after('P23');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuestionarios', function (Blueprint $table) {
            $table->dropColumn('P22');
            $table->dropColumn('P23');
            $table->dropColumn('P24');
        });
    }
}
