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
        Schema::create('servizi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('struttura_id')->constrained('strutture')->onDelete('cascade');
            $table->string('categoria');
            $table->string('nome');
            $table->string('icona');
            $table->boolean('in_evidenza')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servizi');
    }
};
