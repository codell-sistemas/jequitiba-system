<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamento extends Elegant
{
    protected $table = 'lancamento';

    protected $fillable = [
        'nome','tipo'
    ];
}
