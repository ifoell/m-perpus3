<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->unsigned();
            // get from books table

            $table->enum('ownership', ['m', 'o']);
            // m = mine or my book
            // o = others book or I borrow

            $table->integer('person_id')->unsigned();
            // get from person table

            $table->enum('status', ['0', '1'])->nullable()->default('0');
            // 0 = not yet return or the still with me or other
            // 1 = returned

            $table->dateTime('borrow_at')->nullable();
            // time when borrowed

            $table->dateTime('return_at')->nullable();
            // time when borrowed

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrow');
    }
}
