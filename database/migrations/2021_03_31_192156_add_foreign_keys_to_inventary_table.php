<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInventaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventary', function (Blueprint $table) {
            $table->foreign('id_area', 'fk_id_inventary_area')->references('id')->on('area')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventary', function (Blueprint $table) {
            $table->dropForeign('fk_id_inventary_area');
        });
    }
}
