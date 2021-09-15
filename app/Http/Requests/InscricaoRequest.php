<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscricaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'inscricao' => 'required',
            'cpf' => 'required',
            'email' => 'required|email',
            'associado' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'telefone' => 'required',
            'nome_animal' => 'required',
            'modalidade' => 'required',
            'baia_pre_moldada.*' => 'required',
            'total.*' => 'required'
        ];
    }
}
