<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Struttura;
use App\Models\Prenotazione;
use Carbon\CarbonPeriod;

class StrutturaController extends Controller
{
    public function mostra()
    {
        $struttura = Struttura::with(['foto', 'servizi', 'recensioni'])->firstOrFail();

        $prenotazioni = Prenotazione::where('struttura_id', $struttura->id)
            ->whereIn('stato', ['in_attesa', 'confermata'])
            ->where('check_out', '>=', now()->toDateString())
            ->get(['check_in', 'check_out']);

        $dateOccupate = [];
        foreach ($prenotazioni as $prenotazione) {
            // Convertiamo in istanza Carbon sicura per evitare errori di metodo
            $dataIn = \Carbon\Carbon::parse($prenotazione->check_in);
            $dataOut = \Carbon\Carbon::parse($prenotazione->check_out)->subDay();

            $periodo = CarbonPeriod::create($dataIn, $dataOut);
            foreach ($periodo as $data) {
                $dateOccupate[] = $data->toDateString();
            }
        }

        return response()->json([
            'struttura' => $struttura,
            'date_occupate' => array_values(array_unique($dateOccupate)),
        ]);
    }
}