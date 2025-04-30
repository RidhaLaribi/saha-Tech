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
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->text('work_days')->nullable();
            $table->float('rating')->nullable();
            $table->integer('price')->nullable();
            $table->enum('type', ['doctor', 'clinique', 'laboratoire']);
            $table->boolean('available')->default(false);
            $table->enum('gender', ['Homme', 'Femme']);
            $table->string('doctor_ref', 50)->unique();
            $table->integer('age');

            $table->boolean('home_visit')->default(false);
            $table->string('pic')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
