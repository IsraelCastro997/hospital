<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCirugyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cirugy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_patient')->index('fk_id_patient_cirugy');
            $table->unsignedBigInteger('id_doctor')->index('fk_id_doctor_cirugy');
            $table->string('type', 100)->nullable();
            $table->dateTime('dateline')->nullable();
            $table->string('comments', 100)->nullable();
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
        Schema::dropIfExists('area');
    }
}
