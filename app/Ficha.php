<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table = 'ficha';
    
    public static function rankingTempo(){
           $tempos = Ficha::whereNotNull('tempo')->pluck('tempo')->toArray();
           dd($tempos);
    }
}
