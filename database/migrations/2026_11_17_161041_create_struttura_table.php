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
        Schema::create('strutture', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sottotitolo');
            $table->string('codice_cin')->default('IT063049C2DEP0IIUD');
            $table->string('citta')->default('Napoli');
            $table->string('quartiere')->default('Vomero / Arenella');
            $table->integer('ospiti_massimi')->default(4);
            $table->integer('camere_da_letto')->default(1);
            $table->integer('letti')->default(2);
            $table->decimal('bagni', 3, 1)->default(1.5);
            $table->decimal('prezzo_base_notte', 8, 2)->default(115.00);
            $table->decimal('costo_pulizie', 8, 2)->default(35.00);
            $table->decimal('tassa_soggiorno_persona_notte', 5, 2)->default(3.00);
            $table->string('fascia_checkin')->default('14:00 - 00:00');
            $table->string('orario_checkout')->default('10:00');
            $table->text('descrizione_breve');
            $table->longText('descrizione_spazio');
            $table->longText('descrizione_accesso');
            $table->longText('descrizione_quartiere');
            $table->string('nome_host')->default('Luisa');
            $table->decimal('valutazione', 3, 2)->default(4.98);
            $table->integer('numero_recensioni')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strutture');
    }
};
