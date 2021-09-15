<?php

namespace App\Http\Controllers\Backoffice;


use App\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriaController extends Controller
{

    /*
     * Index
     */

    public function index()
    {

        $categorias = Categoria::all();

        return view('backoffice.categoria.index')->with([
            'categorias' => $categorias
        ]);
    }

    public function create()
    {


        return view('backoffice.categoria.create')->with([

        ]);
    }

    public function edit($id)
    {
        $Categoria = Categoria::find($id);

        return view('backoffice.categoria.edit')->with([
            'Categoria' => $Categoria
        ]);
    }

    public function save(CategoriaRequest $categoriaRequest)
    {
        $Categoria = new Categoria();
        $Categoria->nome = $categoriaRequest->get('nome');
        $Categoria->tipo = $categoriaRequest->get('tipo');
        $Categoria->save();

        Geral::setMessage('Categoria cadastrada com sucesso.', 'success');
        return redirect()->route('categoria.index');
    }

    public function update(CategoriaRequest $categoriaRequest, $id)
    {
        $Categoria = Categoria::find($id);
        $Categoria->nome = $categoriaRequest->get('nome');
        $Categoria->tipo = $categoriaRequest->get('tipo');
        $Categoria->update();

        Geral::setMessage('Categoria alterada com sucesso.', 'success');
        return redirect()->route('categoria.index');
    }

    public function delete($id)
    {
        $Categoria = Categoria::find($id);
        $Categoria->delete();

        Geral::setMessage('Categoria excluída com sucesso.', 'success');
        return redirect()->route('categoria.index');
    }

    /*
     * DataTable
     */

    public function data()
    {
        $data = Categoria::latest()->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tipo', function ($row) {
                switch ($row->tipo) {
                    case 'despesa':
                        return '<span class="badge badge-danger">Despesa</span>';
                        break;
                    case 'receita':
                        return '<span class="badge badge-primary">Receita</span>';
                        break;
                }
            })
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('categoria.edit', ['id' => $row->id]) . '" class="btn btn-info btn-md my-0 waves-effect waves-light">
	                           EDITAR
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-md my-0 waves-effect waves-light remover" data-url="' . route('categoria.delete', $row->id) . '" title="Delete">
                               EXCLUIR                
                        </a>';


                return $btn;
            })
            ->rawColumns(['tipo', 'action'])
            ->make(true);

    }

}
