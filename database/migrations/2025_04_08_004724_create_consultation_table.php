<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('consultation', function (Blueprint $table) {
            $table->id();
            $table->integer('rendez_vous_id');
            $table->integer('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->text('note');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');

            $table->foreign('rendez_vous_id')->references('idrdv')->on('rendez_vous');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation');
    }
};