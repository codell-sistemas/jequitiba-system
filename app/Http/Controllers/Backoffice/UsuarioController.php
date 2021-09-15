<?php

namespace App\Http\Controllers\Backoffice;


use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\JsValidationServiceProvider;

class UsuarioController extends Controller
{

    /*
     * Index
     */

    public function index()
    {
        return view('backoffice.usuario.index')->with([
        ]);
    }

    /*
    * Novo
    */

    public function create()
    {
        return view('backoffice.usuario.create')->with([

        ]);
    }


    /*
     * Salvar usuário
     */

    public function save(UsuarioRequest $request)
    {
        $Usuario = new Usuario();
        $Usuario->fill($request->all());
        $Usuario->senha = md5($request->get('senha'));
        $Usuario->save();

        return redirect()->back()->with(['success' => 'Usuário cadastrado com sucesso.']);
    }

    /*
    * Editar
    */

    public function edit($id)
    {
        $Usuario = Usuario::find($id);


        return view('backoffice.usuario.edit')->with([
            'Usuario' => $Usuario,
        ]);
    }

    /*
     * Atualizar usuário
     */
    public function update(UsuarioUpdateRequest $request, $id)
    {
        $Usuario = Usuario::find($id);
        $Usuario->fill($request->all());
        $Usuario->update();

        return redirect()->back()->with(['success' => 'Usuário alterado com sucesso.']);
    }

    /*
     * Excluir usuário
     */
    public function delete($id)
    {
        $Usuario = Usuario::find($id);
        $Usuario->delete();

        Geral::setMessage('Usuário excluído com sucesso', 'success');
        return redirect()->back();
    }

    /*
     * DataTable
     */

    public function data()
    {
        $data = Usuario::latest()->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('usuario.edit', ['id' => $row->id]) . '" class="btn btn-info btn-md my-0 waves-effect waves-light">
	                           EDITAR
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-md my-0 waves-effect waves-light remover" data-url="' . route('usuario.delete', $row->id) . '" title="Delete">
                               EXCLUIR                
                        </a>';


                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
