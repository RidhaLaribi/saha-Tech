<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('avis_medecin', function (Blueprint $table) {
            $table->integer('id_medecin');
            $table->integer('user_id');
            $table->text('avis');
            $table->integer('star');

            $table->foreign('id_medecin')->references('id')->on('doctors');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    public function down()
    {
        Schema::dropIfExists('avis_medecin');
    }
};