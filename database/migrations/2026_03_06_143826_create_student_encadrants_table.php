<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_encadrants', function (Blueprint $table) {

            $table->id();

            $table->foreignId('etudiant_id')
                ->constrained('etudiants')
                ->onDelete('cascade');

            $table->foreignId('encadrant_id')
                ->constrained('encadrants')
                ->onDelete('cascade');

            $table->string('type');

            $table->date('date_assignation');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_encadrants');
    }
};
