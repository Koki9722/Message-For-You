<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnBoardnumbernowBoardList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('board_lists', function (Blueprint $table) {
            $table->dropColumn('board_number_now');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('board_lists', function (Blueprint $table) {
            $table->unsignedInteger('board_number_now');
        });
    }
}
