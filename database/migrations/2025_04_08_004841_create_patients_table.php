<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->binary('pic')->nullable();
            $table->string('name');
            $table->integer('age');
            $table->enum('sexe', ['Homme', 'Femme']);
            $table->string('rel')->default('self');
            $table->timestamps();

           
        $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};