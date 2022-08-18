<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnoseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnose', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_patient')->index('fk_id_patient_diagnose');
            $table->unsignedBigInteger('id_doctor')->index('fk_id_doctor_diagnose');
            $table->string('disease', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->float('weight', 10, 0)->nullable();
            $table->string('notes', 1000)->nullable();
            $table->string('drugs', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnose');
    }
}
