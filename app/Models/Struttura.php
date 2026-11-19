<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Struttura extends Model
{
    protected $table = 'strutture';
    protected $guarded = [];

    public function foto()
    {
        return $this->hasMany(Foto::class, 'struttura_id')->orderBy('ordine');
    }

    public function servizi()
    {
        return $this->hasMany(Servizio::class, 'struttura_id');
    }

    public function recensioni()
    {
        return $this->hasMany(Recensione::class, 'struttura_id')->where('visibile', true);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class, 'struttura_id');
    }
}
