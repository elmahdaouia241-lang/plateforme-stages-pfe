<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {

            $table->id();

            $table->foreignId('etudiant_id')
                ->constrained('etudiants')
                ->onDelete('cascade');

            $table->foreignId('destinataire_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('nom_document');

            $table->string('type_document');

            $table->string('fichier');

            $table->string('taille');

            $table->enum('status', ['pending','viewed','validated','rejected'])
                ->default('pending');

            $table->text('commentaire')->nullable();

            $table->date('date_depot');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};