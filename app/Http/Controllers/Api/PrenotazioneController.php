<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Struttura;
use App\Models\Prenotazione;
use App\Services\CalcoloPrenotazioneService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrenotazioneController extends Controller
{
    public function __construct(private CalcoloPrenotazioneService $calcolatore) {}

    public function preventivo(Request $request)
    {
        $datiValidati = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'ospiti' => 'required|integer|min:1|max:4',
        ]);

        $struttura = Struttura::firstOrFail();
        $preventivo = $this->calcolatore->calcolaPreventivo(
            $struttura,
            $datiValidati['check_in'],
            $datiValidati['check_out'],
            (int) $datiValidati['ospiti']
        );

        return response()->json($preventivo);
    }

    public function crea(Request $request)
    {
        $datiValidati = $request->validate([
            'nome_ospite' => 'required|string|max:120',
            'email_ospite' => 'required|email|max:120',
            'telefono_ospite' => 'required|string|max:30',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'numero_ospiti' => 'required|integer|min:1|max:4',
            'richiesta_culla' => 'boolean',
            'note' => 'nullable|string|max:1000',
        ]);

        $struttura = Struttura::firstOrFail();
        $preventivo = $this->calcolatore->calcolaPreventivo(
            $struttura,
            $datiValidati['check_in'],
            $datiValidati['check_out'],
            (int) $datiValidati['numero_ospiti']
        );

        if (!$preventivo['disponibile']) {
            return response()->json([
                'messaggio' => 'Le date selezionate non sono più disponibili.'
            ], 422);
        }

        $prenotazione = Prenotazione::create([
            'struttura_id' => $struttura->id,
            'codice_prenotazione' => 'LULU-' . strtoupper(Str::random(5)),
            'nome_ospite' => $datiValidati['nome_ospite'],
            'email_ospite' => $datiValidati['email_ospite'],
            'telefono_ospite' => $datiValidati['telefono_ospite'],
            'check_in' => $datiValidati['check_in'],
            'check_out' => $datiValidati['check_out'],
            'numero_ospiti' => $datiValidati['numero_ospiti'],
            'notti' => $preventivo['notti'],
            'subtotale_notti' => $preventivo['subtotale_notti'],
            'costo_pulizie' => $preventivo['costo_pulizie'],
            'tassa_soggiorno' => $preventivo['tassa_soggiorno'],
            'totale_prezzo' => $preventivo['totale_prezzo'],
            'richiesta_culla' => $datiValidati['richiesta_culla'] ?? false,
            'note' => $datiValidati['note'] ?? null,
            'stato' => 'in_attesa',
        ]);

        return response()->json([
            'messaggio' => 'Richiesta inviata! Luisa ti risponderà entro 1 ora.',
            'prenotazione' => $prenotazione,
        ], 201);
    }

    public function elenco()
    {
        return response()->json(Prenotazione::orderByDesc('created_at')->get());
    }

    public function aggiornaStato(Request $request, Prenotazione $prenotazione)
    {
        $datiValidati = $request->validate([
            'stato' => 'required|in:in_attesa,confermata,annullata',
        ]);

        $prenotazione->update(['stato' => $datiValidati['stato']]);

        return response()->json($prenotazione);
    }
}