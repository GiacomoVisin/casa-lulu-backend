<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recensioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('struttura_id')->constrained('strutture')->onDelete('cascade');
            $table->string('nome_ospite');
            $table->string('periodo_soggiorno');
            $table->tinyInteger('voto')->default(5);
            $table->text('commento');
            $table->boolean('visibile')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensioni');
    }
};
