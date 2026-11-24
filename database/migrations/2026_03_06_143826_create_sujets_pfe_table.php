<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sujets_pfe', function (Blueprint $table) {

            $table->id();

            $table->string('titre');

            $table->text('description');

            $table->string('specialite');

            $table->integer('nb_etudiants');

            $table->enum('status', ['disponible','assigne'])
                ->default('disponible');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sujets_pfe');
    }
};
