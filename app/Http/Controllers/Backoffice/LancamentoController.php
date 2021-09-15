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

        $lancamentos = Lancamento::all();

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

        Geral::setMessage('Lancamento cadastrada com sucesso.', 'success');
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

        Geral::setMessage('Lancamento excluída com sucesso.', 'success');
        return redirect()->route('lancamento.index');
    }

    /*
     * DataTable
     */

    public function data()
    {
        $data = Lancamento::latest()->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('categoria', function ($row) {
                $Categoria = Categoria::find($row->id_categoria);
                if ($Categoria) {
                    if ($Categoria->tipo == 'receita') {
                        return '<span class="badge badge-primary">' . $Categoria->nome . '</span>';
                    } else {
                        return '<span class="badge badge-danger">' . $Categoria->nome . '</span>';
                    }
                }
            })
            ->addColumn('data_vencimento', function ($row) {
                return Geral::dateInput($row->data_vencimento);
            })
            ->addColumn('baixa', function ($row) {
                if ($row->baixa) {
                    return 'Sim';
                } else {
                    return 'Não';
                }
            })
            ->addColumn('valor', function ($row) {
                return Geral::moneyFormat($row->valor);
            })
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('lancamento.edit', ['id' => $row->id]) . '" class="btn btn-info btn-md my-0 waves-effect waves-light">
	                           EDITAR
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-md my-0 waves-effect waves-light remover" data-url="' . route('lancamento.delete', $row->id) . '" title="Delete">
                               EXCLUIR                
                        </a>';


                return $btn;
            })
            ->rawColumns(['categoria', 'data_vencimento', 'baixa', 'action'])
            ->make(true);

    }

}
