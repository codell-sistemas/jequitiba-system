<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
          /*  'cnpj' => 'required',
            'inscricao_municipal' => 'required',
            'inscricao_estadual' => 'required',
            'telefone' => 'required',
            'celular' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'complemento' => 'required',
            'cep' => 'required',*/
            'uf' => 'required',
            'cidade' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'razao_social.required' => 'O campo razão social é obrigatório.',
            'inscricao_municipal.required' => 'O campo inscrição municipal é obrigatório.',
            'inscricao_estadual.required' => 'O campo inscrição estadual é obrigatório.',
        ];
    }
}
