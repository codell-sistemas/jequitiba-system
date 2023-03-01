<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';

    protected $fillable = ['*'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idusuario');
    }
}
