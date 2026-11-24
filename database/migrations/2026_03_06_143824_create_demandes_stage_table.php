<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes_stage', function (Blueprint $table) {

            $table->id();

            $table->foreignId('etudiant_id')
                ->constrained('etudiants')
                ->onDelete('cascade');

            $table->string('entreprise');
            $table->string('ville');
            $table->string('periode');
            $table->string('type');

            $table->text('sujet');

            $table->enum('status', ['pending','accepted','rejected'])
                ->default('pending');

            $table->date('date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_stage');
    }
};