<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('historique_patient', function (Blueprint $table) {
            $table->integer('id_patient');
            $table->timestamp('date_inscription')->useCurrent();
            $table->dateTime('date_rdv_specialiste');
            $table->text('diagnostic');

            $table->foreign('id_patient')->references('id')->on('patients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historique_patient');
    }
};