<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedilinkData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alliances', function (Blueprint $table) {
            $table->string('alliance_name')->nullable()->after('desc');
            $table->string('contact_name')->nullable()->after('alliance_name');
            $table->string('contact_phone_1')->nullable()->after('contact_name');
            $table->string('contact_phone_2')->nullable()->after('contact_phone_1');
            $table->string('city')->nullable()->after('contact_phone_2');
            $table->string('state')->nullable()->after('city');
            $table->string('email')->nullable()->after('state');
            $table->float('medilink_desc')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alliances', function (Blueprint $table) {
            $table->dropColumn('alliance_name');
            $table->dropColumn('contact_name');
            $table->dropColumn('contact_phone_1');
            $table->dropColumn('contact_phone_2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('email');
            $table->dropColumn('medilink_desc');
        });
    }
}
