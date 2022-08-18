<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('ns', 30)->nullable();
            $table->string('CURP', 20)->nullable();
            $table->timestamps();
            $table->tinyInteger('gender')->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('marita_status', 30)->nullable();
            $table->float('weight', 10, 0)->nullable();
            $table->float('height', 10, 0)->nullable();
            $table->string('phone_sec', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('image', 200)->nullable();
           
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient');
    }
}
