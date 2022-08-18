<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddforeignkeyRoleuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('role_id', 'fk_id_role_roleuser')->references('id')->on('roles')->onDelete('RESTRICT');
            $table->foreign('user_id', 'fk_id_user_roleuser')->references('id')->on('users')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('fk_id_role_roleuser');
            $table->dropForeign('fk_id_user_roleuser');
            
        });
    }
}
