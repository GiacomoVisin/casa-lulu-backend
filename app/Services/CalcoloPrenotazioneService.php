<?php

namespace App\Services;

use App\Models\Struttura;
use App\Models\Prenotazione;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CalcoloPrenotazioneService
{
    public function verificaDisponibilita(Struttura $struttura, string $checkIn, string $checkOut): bool
    {
        return !Prenotazione::where('struttura_id', $struttura->id)
            ->whereIn('stato', ['in_attesa', 'confermata'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            })
            ->exists();
    }

    public function calcolaPreventivo(Struttura $struttura, string $checkIn, string $checkOut, int $ospiti): array
    {
        $inizio = Carbon::parse($checkIn)->startOfDay();
        $fine = Carbon::parse($checkOut)->startOfDay();
        $notti = $inizio->diffInDays($fine);

        if ($notti < 1) {
            throw new \InvalidArgumentException('Il soggiorno deve essere di almeno 1 notte.');
        }

        if ($ospiti < 1 || $ospiti > $struttura->ospiti_massimi) {
            throw new \InvalidArgumentException("Numero ospiti non valido (massimo {$struttura->ospiti_massimi}).");
        }

        // Calcoliamo qui la disponibilità usando il metodo dedicato
        $disponibile = $this->verificaDisponibilita($struttura, $inizio->toDateString(), $fine->toDateString());

        $subtotaleNotti = 0;
        $periodo = CarbonPeriod::create($inizio, $fine->copy()->subDay());

        foreach ($periodo as $data) {
            $tariffaNotte = (float) $struttura->prezzo_base_notte;

            // Maggiorazione weekend (Venerdì e Sabato +15%) ed estate (Giugno-Settembre +10%)
            if ($data->isFriday() || $data->isSaturday()) {
                $tariffaNotte *= 1.15;
            }
            if (in_array($data->month, [6, 7, 8, 9])) {
                $tariffaNotte *= 1.10;
            }

            $subtotaleNotti += round($tariffaNotte, 2);
        }

        $costoPulizie = (float) $struttura->costo_pulizie;
        $tassaSoggiorno = round($ospiti * $notti * (float) $struttura->tassa_soggiorno_persona_notte, 2);
        $totalePrezzo = round($subtotaleNotti + $costoPulizie + $tassaSoggiorno, 2);

        return [
            'disponibile' => $disponibile,
            'notti' => $notti,
            'ospiti' => $ospiti,
            'subtotale_notti' => $subtotaleNotti,
            'tariffa_media_notte' => round($subtotaleNotti / $notti, 2),
            'costo_pulizie' => $costoPulizie,
            'tassa_soggiorno' => $tassaSoggiorno,
            'totale_prezzo' => $totalePrezzo,
            'valuta' => 'EUR',
        ];
    }
}