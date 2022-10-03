<?php

namespace App\Http\Controllers\Backoffice;


use App\Categoria;
use App\Lancamento;
use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Http\Requests\LancamentoRequest;

class LancamentoController extends Controller
{

    /*
     * Index
     */

    public function index()
    {

        $lancamentos = new Lancamento();
        if ((int)request()->get('id_categoria')) {
            $lancamentos = $lancamentos->where('id_categoria', request()->get('id_categoria'));
        }
        if (request()->get('data')) {
            $lancamentos = $lancamentos->where('data_vencimento', Geral::dateInput(request()->get('data')));
        }
        if (request()->get('descricaao')) {
            $lancamentos = $lancamentos->where('nome', 'like', '%' . request()->get('descricao') . '%');
        }
        $lancamentos = $lancamentos->orderBy('data_vencimento','DESC')->get();

        return view('backoffice.lancamento.index')->with([
            'lancamentos' => $lancamentos
        ]);
    }

    public function create()
    {
        return view('backoffice.lancamento.create')->with([

        ]);
    }

    public function edit($id)
    {
        $Lancamento = Lancamento::find($id);
        $Lancamento->data_vencimento = Geral::dateInput($Lancamento->data_vencimento);

        return view('backoffice.lancamento.edit')->with([
            'Lancamento' => $Lancamento
        ]);
    }

    public function save(LancamentoRequest $lancamentoRequest)
    {
        $Lancamento = new Lancamento();
        $Lancamento->nome = $lancamentoRequest->get('nome');
        $Lancamento->id_categoria = $lancamentoRequest->get('id_categoria');
        $Lancamento->valor = Geral::onlyNumber($lancamentoRequest->get('valor'));
        $Lancamento->data_vencimento = \DateTime::createFromFormat('d/m/Y', $lancamentoRequest->get('data_vencimento'))->format('Y-m-d H:i:s');
        $Lancamento->baixa = $lancamentoRequest->get('baixa') ? 1 : 0;
        $Lancamento->save();

        Geral::setMessage('Lançamento cadastrado com sucesso.', 'success');
        return redirect()->route('lancamento.index');
    }

    public function update(LancamentoRequest $lancamentoRequest, $id)
    {
        $Lancamento = Lancamento::find($id);
        $Lancamento->nome = $lancamentoRequest->get('nome');
        $Lancamento->id_categoria = $lancamentoRequest->get('id_categoria');
        $Lancamento->valor = Geral::onlyNumber($lancamentoRequest->get('valor'));
        $Lancamento->data_vencimento = \DateTime::createFromFormat('d/m/Y', $lancamentoRequest->get('data_vencimento'))->format('Y-m-d H:i:s');
        $Lancamento->baixa = $lancamentoRequest->get('baixa') ? 1 : 0;
        $Lancamento->update();

        Geral::setMessage('Lancamento alterado com sucesso.', 'success');
        return redirect()->route('lancamento.index');
    }

    public function delete($id)
    {
        $Lancamento = Lancamento::find($id);
        $Lancamento->delete();

        Geral::setMessage('Lançamento excluído com sucesso.', 'success');
        return redirect()->route('lancamento.index');
    }

}
