<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('consultation', function (Blueprint $table) {
            $table->integer('idcns', true);
            $table->integer('rendez_vous_id');
            $table->text('note');
            $table->unsignedBigInteger('doctor_id');

            $table->foreign('rendez_vous_id')->references('idrdv')->on('rendez_vous');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation');
    }
};