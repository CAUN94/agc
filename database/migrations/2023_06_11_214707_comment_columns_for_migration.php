<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentColumnsForMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('nutrition', function (Blueprint $table) {
           $table->string('comment')->after('deporte')->default('')->nullable();
           $table->float('oseo_referencial')->after('abdominal')->default(1);
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('nutrition', function (Blueprint $table) {
           $table->binary('pdf');
           $table->float('diferencia_peso');
         });
     }
}
