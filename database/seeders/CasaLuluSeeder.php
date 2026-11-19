<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Struttura;

class CasaLuluSeeder extends Seeder
{
    public function run(): void
    {
        $struttura = Struttura::create([
            'nome' => 'Casa Lulù',
            'sottotitolo' => 'Casa accogliente a Vomero - Vicino alla metropolitana',
            'codice_cin' => 'IT063049C2DEP0IIUD',
            'citta' => 'Napoli',
            'quartiere' => 'Vomero / Arenella',
            'ospiti_massimi' => 4,
            'camere_da_letto' => 1,
            'letti' => 2,
            'bagni' => 1.5,
            'prezzo_base_notte' => 115.00,
            'costo_pulizie' => 35.00,
            'tassa_soggiorno_persona_notte' => 3.00,
            'fascia_checkin' => '14:00 - 00:00',
            'orario_checkout' => '10:00',
            'descrizione_breve' => "Casa Lulù ti aspetta nel cuore del Vomero/Arenella, a due passi dalla storica Certosa di San Martino e dalla Linea 1 della Metropolitana.",
            'descrizione_spazio' => "Appartamento spazioso ed elegante su due livelli al piano terra di una palazzina signorile e silenziosa, senza scale né ascensori d'ingresso. Al piano principale: luminoso open space con salotto e divano letto, cucina attrezzata (piano a induzione, microonde, bollitore, macchina espresso), snack bar e bagno con ampia cabina doccia. Al piano superiore: camera matrimoniale Queen Size con secondo bagno privato e arredi su misura.",
            'descrizione_accesso' => "Intero appartamento ad uso esclusivo con accesso diretto al piano terra. Accoglienza personale al check-in (flessibile su richiesta) e assistenza completa per navette, escursioni e consigli gastronomici.",
            'descrizione_quartiere' => "Il Vomero è uno dei quartieri residenziali più eleganti e sicuri di Napoli. A pochi passi si trovano il rinnovato Parco Mascagna, la Certosa di San Martino, Castel Sant'Elmo e le vie dello shopping. Metro Linea 1 a 5 minuti a piedi per raggiungere rapidamente il Centro Storico e il Lungomare.",
            'nome_host' => 'Luisa',
            'valutazione' => 4.98,
            'numero_recensioni' => 60,
        ]);

        // Esempio all'interno del tuo Seeder:
        $struttura->foto()->createMany([
            [
                'url' => '/immagini/foto1.jpg', // <-- Sostituisci con il nome esatto del tuo file 1
                'didascalia' => 'Soggiorno luminoso di Casa Lulù',
                'ordine' => 1
            ],
            [
                'url' => '/immagini/foto2.jpg',    // <-- Sostituisci con il nome esatto del tuo file 2
                'didascalia' => 'Camera da letto matrimoniale',
                'ordine' => 2
            ],
            [
                'url' => '/immagini/foto3.jpg',    // <-- Sostituisci con il nome esatto del tuo file 3
                'didascalia' => 'Cucina attrezzata',
                'ordine' => 3
            ],
            [
                'url' => '/immagini/foto4.jpg',     // <-- Sostituisci con il nome esatto del tuo file 4
                'didascalia' => 'Bagno moderno con doccia',
                'ordine' => 4
            ],
            [
                'url' => '/immagini/foto5.jpg',  // <-- Sostituisci con il nome esatto del tuo file 5
                'didascalia' => 'Balcone / Vista Vomero',
                'ordine' => 5
            ],
        ]);

        $struttura->servizi()->createMany([
            ['categoria' => 'Connettività & Media', 'nome' => 'Wi-Fi fibra ultraveloce (212 Mbps)', 'icona' => 'wifi', 'in_evidenza' => true],
            ['categoria' => 'Connettività & Media', 'nome' => 'Smart TV 4K con servizi streaming', 'icona' => 'tv', 'in_evidenza' => false],
            ['categoria' => 'Cucina', 'nome' => 'Angolo cottura con piano a induzione', 'icona' => 'utensils', 'in_evidenza' => true],
            ['categoria' => 'Cucina', 'nome' => 'Macchina per caffè espresso, bollitore e microonde', 'icona' => 'coffee', 'in_evidenza' => true],
            ['categoria' => 'Comfort', 'nome' => 'Aria condizionata e riscaldamento', 'icona' => 'snowflake', 'in_evidenza' => true],
            ['categoria' => 'Comfort', 'nome' => 'Lenzuola in cotone pregiato e set asciugamani', 'icona' => 'bed', 'in_evidenza' => false],
            ['categoria' => 'Famiglia', 'nome' => 'Culla, seggiolone e scaldabiberon su richiesta', 'icona' => 'baby', 'in_evidenza' => true],
            ['categoria' => 'Posizione & Extra', 'nome' => 'Accesso piano terra senza barriere', 'icona' => 'door-open', 'in_evidenza' => true],
            ['categoria' => 'Posizione & Extra', 'nome' => 'Parcheggio convenzionato a 50 metri', 'icona' => 'car', 'in_evidenza' => false],
            ['categoria' => 'Posizione & Extra', 'nome' => 'Animali domestici ammessi & Teli mare in estate', 'icona' => 'paw', 'in_evidenza' => false],
        ]);

        $struttura->recensioni()->createMany([
            ['nome_ospite' => 'Anica', 'periodo_soggiorno' => 'Ottobre 2026', 'voto' => 5, 'commento' => "L'appartamento di Luisa è pulito e accogliente. Nelle vicinanze ci sono vie dello shopping, buoni ristoranti e attrazioni turistiche. Si può raggiungere rapidamente il centro con la metropolitana. Luisa è gentilissima!"],
            ['nome_ospite' => 'Jean-François', 'periodo_soggiorno' => 'Ottobre 2026', 'voto' => 5, 'commento' => "Soggiorno eccellente. Alloggio molto pulito e accogliente, cestino di snack di benvenuto molto apprezzato. La linea 1 della metropolitana è vicina e permette di scoprire Napoli."],
            ['nome_ospite' => 'Paula', 'periodo_soggiorno' => 'Ottobre 2026', 'voto' => 5, 'commento' => "Esattamente come si vede nelle foto. Molto pulito e ristrutturato, in una zona tranquilla. Luisa è adorabile e molto premurosa."],
            ['nome_ospite' => 'Angeles', 'periodo_soggiorno' => 'Settembre 2026', 'voto' => 5, 'commento' => "Posizione perfetta nel quartiere tranquillo e sicuro del Vomero, metropolitana a 5 minuti a piedi. Silenzioso, letto e cuscini di alta qualità."],
            ['nome_ospite' => 'Rossella', 'periodo_soggiorno' => 'Agosto 2026', 'voto' => 5, 'commento' => "Luisa e suo marito sono host molto disponibili. Appartamento ben disposto e arredato con gusto, i due bagni per una famiglia di 4 persone sono comodissimi."],
        ]);
    }
}