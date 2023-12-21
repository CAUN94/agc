<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportColumnToActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_mls', function (Blueprint $table) {
            $table->boolean('Report')->defalut(0)->after('Evolution');
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
            $table->dropColumn('Report');
        });
    }
}
