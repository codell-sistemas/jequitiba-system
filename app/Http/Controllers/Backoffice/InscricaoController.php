<?php

namespace App\Http\Controllers\Backoffice;


use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Inscricao;
use App\Http\Requests\InscricaoRequest;

class InscricaoController extends Controller
{

    /*
     * Index
     */

    public function index()
    {
        return view('backoffice.inscricao.index')->with([
        ]);
    }

    /*
     * Editar
     */

    public function view($id)
    {
        $Inscricao = Inscricao::find($id);
        $Inscricao->telefone = Geral::telefone($Inscricao->telefone);
        $Inscricao->whatsapp = Geral::telefone($Inscricao->whatsapp);
        $fichas = $Inscricao->fichas;

        return view('backoffice.inscricao.view')->with([
            'Inscricao' => $Inscricao,
            'fichas' => $fichas
        ]);
    }

    /*
     * Impriir
     */
    public function print($id)
    {
        $Inscricao = Inscricao::find($id);
        $fichas = $Inscricao->fichas;

        return view('backoffice.inscricao.print')->with([
            'Inscricao' => $Inscricao,
            'fichas' => $fichas
        ]);
    }

    /*
     * Novo
     */

    public function create()
    {
        return view('backoffice.inscricao.create')->with([

        ]);
    }


    /*
     * Salvar inscricao
     */

    public function save(InscricaoRequest $request)
    {
        $inscricao = new Inscricao();
        $inscricao->fill($request->all());
        $inscricao->save();

        return redirect()->route('inscricao.edit', ['id' => $inscricao->id])->with(['success' => 'Inscricao cadastrado com sucesso.']);
    }

    /*
     * Atualizar usuário
     */
    public function update(InscricaoRequest $request, $id)
    {
        $inscricao = Inscricao::find($id);
        $inscricao->fill($request->all());
        $inscricao->update();

        return redirect()->back()->with(['success' => 'Inscricao alterado com sucesso.']);
    }

    /*
     * Excluir usuário
     */
    public function delete($id)
    {
        $Inscricao = Inscricao::find($id);
        $Inscricao->delete();

        Geral::setMessage('Inscrição excluída com sucesso', 'danger');
        return redirect()->back();
    }


    /*
     * DataTable
     */

    public function data()
    {
        $data = Inscricao::all();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total', function ($row) {
                return Geral::moneyFormat($row->total);
            })
            ->addColumn('status', function ($row) {
                return $row->status();
            })->addColumn('telefone', function ($row) {
                return Geral::telefone($row->telefone);
            })
            ->addColumn('data', function ($row) {
                return \DateTime::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                $btn = '
                <a href="' . route('inscricao.view', $row->id) . '" class="btn btn-info btn-md">VER</a>
                <a href="javascript:void(0);" class="btn btn-danger btn-md my-0 waves-effect waves-light remover" data-url="' . route('inscricao.delete', $row->id) . '" title="Deletar">
                               EXCLUIR                
                        </a>';

                return $btn;
            })
            ->rawColumns(['telefone', 'status', 'action', 'total', 'data'])
            ->make(true);

    }

}
