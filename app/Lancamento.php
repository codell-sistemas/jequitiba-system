<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    protected $table = 'lancamento';

    protected $fillable = [
        'nome','tipo'
    ];
}
