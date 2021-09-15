<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'inscricao';

    protected $fillable = [
        'nome',
        'cep',
        'cpf',
        'cnpj',
        'endereco',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'uf',
        'telefone',
        'email',
        'conta_bancaria',
        'observacoes'
    ];
}
