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
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('struttura_id')->constrained('strutture')->onDelete('cascade');
            $table->string('codice_prenotazione')->unique();
            $table->string('nome_ospite');
            $table->string('email_ospite');
            $table->string('telefono_ospite');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('numero_ospiti');
            $table->integer('notti');
            $table->decimal('subtotale_notti', 8, 2);
            $table->decimal('costo_pulizie', 8, 2);
            $table->decimal('tassa_soggiorno', 8, 2);
            $table->decimal('totale_prezzo', 8, 2);
            $table->boolean('richiesta_culla')->default(false);
            $table->text('note')->nullable();
            $table->enum('stato', ['in_attesa', 'confermata', 'annullata'])->default('in_attesa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenotazioni');
    }
};
