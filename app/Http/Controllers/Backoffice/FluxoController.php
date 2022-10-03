<?php

namespace App\Http\Controllers\Backoffice;


use App\Categoria;
use App\Lancamento;
use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Http\Requests\LancamentoRequest;

class FluxoController extends Controller
{

    /*
     * Index
     */

    public function index()
    {
        $despesas = Categoria::where('tipo', 'despesa')->get();
        $receitas = Categoria::where('tipo', 'receita')->get();

        $tipo_lancamento = request()->get('tipo_lancamento','previsto');
        $ano = request()->get('ano',date('Y'));
        $baixa = ($tipo_lancamento == 'previsto' ? 0 : 1);

        return view('backoffice.fluxo.index')->with([
            'despesas' => $despesas,
            'receitas' => $receitas,
            'tipo_lancamento' => $tipo_lancamento,
            'ano' => $ano,
            'baixa' => $baixa
        ]);
    }


}
