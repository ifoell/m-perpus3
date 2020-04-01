<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBorrowreturnBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borrow', function (Blueprint $table) {
            $table->dropColumn('borrow_at');
            $table->dropColumn('return_at');
        });
        Schema::table('borrow', function (Blueprint $table) {
            $table->date('borrow_at')->nullable();
            $table->date('return_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrow', function (Blueprint $table) {
            //
        });
    }
}
