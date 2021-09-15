<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email'
    ];

    public function estabelecimentoUsuario()
    {
        return $this->hasMany(EstabelecimentoUsuario::class, 'usuario_id');
    }

    public function estabelecimentos()
    {
        return $this->belongsToMany(Estabelecimento::class, EstabelecimentoUsuario::class, 'usuario_id','estabelecimento_id');
    }
}
