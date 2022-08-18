<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDiagnoseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnose', function (Blueprint $table) {
            $table->foreign('id_doctor', 'fk_id_doctor_diagnose')->references('id')->on('users')->onDelete('RESTRICT');
            $table->foreign('id_patient', 'fk_id_patient_diagnose')->references('id')->on('patient')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnose', function (Blueprint $table) {
            $table->dropForeign('fk_id_doctor_diagnose');
            $table->dropForeign('fk_id_patient_diagnose');
        });
    }
}
