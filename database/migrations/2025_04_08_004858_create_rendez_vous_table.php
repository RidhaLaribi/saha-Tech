<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->integer('idrdv', true);
            $table->integer('user_id');
            $table->integer('medcin_id');
            $table->dateTime('rendezvous');
            $table->enum('status', ['En Attente', 'Confirmé', 'Annulé', ''])->default('En Attente');
            $table->string('type', 100);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medcin_id')->references('id')->on('doctors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rendez_vous');
    }
};