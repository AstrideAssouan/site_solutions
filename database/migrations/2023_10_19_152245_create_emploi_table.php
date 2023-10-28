<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emploi', function (Blueprint $table) {
            $table->id();
            $table->string('intitule_poste');
            $table->string('date_publication');
            $table->string('date_limite');
            $table->string('niveau_etude');
            $table->string('localisation');
            $table->string('secteur_activite');
            $table->string('description_poste');
            $table->string('missions');
            $table->string('remuneration');
            $table->foreignId('categorie_id')->constrained('categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi');
    }
};
