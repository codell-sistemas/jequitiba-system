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
        $lancamentos = Lancamento::all();

        $despesas = Categoria::where('tipo', 'despesa')->get();
        $receitas = Categoria::where('tipo', 'receita')->get();

        return view('backoffice.fluxo.index')->with([
            'despesas' => $despesas,
            'receitas' => $receitas
        ]);
    }


}
