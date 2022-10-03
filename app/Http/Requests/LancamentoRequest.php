<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoRequest extends FormRequest
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
        $rules = [
            'nome' => 'required',
            'id_categoria' => 'required',
            'valor' => 'required',
            'data_vencimento' => 'required|date_format:d/m/Y',
        ];

        if ($this->request->get('repetir')) {
            $rules['repetir_vezes'] = 'required|numeric';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'repetir_vezes.required' => 'O campo quantidade de repetições é obrigatório.',
            'id_categoria.required' => 'O campo categoria é obrigatório.'
        ];
    }
}
