<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserIdColumnOnTrainBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('train_books', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('train_appointment_id')->nullable()->change();
            $table->dropForeign('train_books_user_id_foreign');
            $table->dropForeign('train_books_train_appointment_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->change();
            $table->foreign('train_appointment_id')->references('id')->on('train_appointments')
                ->cascadeOnUpdate()->nullOnDelete()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('train_books', function (Blueprint $table) {
            //
        });
    }
}
