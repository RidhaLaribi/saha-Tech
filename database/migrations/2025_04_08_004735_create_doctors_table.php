<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('specialty');
            $table->string('location');
            $table->date('date');
            $table->float('rating');
            $table->integer('price');
            $table->enum('type', ['doctor', 'clinique', 'laboratoire']);
            $table->boolean('available')->default(true);
            $table->enum('gender', ['Homme', 'Femme']);
            $table->string('doctor_ref', 50)->nullable();
            $table->integer('age');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};