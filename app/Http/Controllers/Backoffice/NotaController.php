<?php

namespace App\Http\Controllers\Backoffice;

use App\Ficha;
use App\Http\Custom\Geral;
use App\Inscricao;
use App\Modalidade;
use App\Nota;
use App\Http\Requests\NotaRequest;
use Illuminate\Http\Request;

class NotaController extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {
        return view('backoffice.nota.index');
    }


    public function data()
    {
        $data = Ficha::orderBy('created_at','DESC')->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nota', function ($row) {
                $disabled = '';
                $Modalidade = Modalidade::where('nome', $row->modalidade)->first();

                if ($Modalidade) {
                    if ($Modalidade->tipo_nota == 'tempo' || $Modalidade->tipo_nota == 'dupla' || $Modalidade->tipo_nota == 'trio') {
                        $disabled = 'disabled';
                    }
                }

                $btn = '<input name="nota['.$row->id.']" id="nota-'.$row->id.'" class="form-control nota" value="'.$row->nota.'" ' . $disabled . '/>';

                return $btn;
            })
            ->addColumn('tempo', function ($row) {
                $disabled = '';
                $Modalidade = Modalidade::where('nome', $row->modalidade)->first();
                if ($Modalidade) {
                    if ($Modalidade->tipo_nota == 'nota') {
                        $disabled = 'disabled';
                    }
                }

                $btn = '<input name="tempo['.$row->id.']" id="tempo-'.$row->id.'" class="form-control timeabc" value="'.$row->tempo.'" ' . $disabled . '/>';

                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" class="btn btn-info btn-md salvarNota" id="'.$row->id.'">SALVAR</a>';

                return $btn;
            })
            ->rawColumns(['inscricao', 'modalidade', 'nome_animal', 'nome_cavaleiro', 'nota', 'tempo', 'action'])
            ->make(true);

    }

    public function save(Request $request, $id)
    {

        $Ficha = Ficha::find($id);
        $Ficha->tempo = $request->get('tempo');
        $Ficha->nota = $request->get('nota');
        $Ficha->nome_cavaleiro2 = $request->get('nome_cavaleiro2');
        $Ficha->nome_cavaleiro3 = $request->get('nome_cavaleiro3');
        $Ficha->qtde_bois = $request->get('qtde_bois');
        $Ficha->update();

        if($request->ajax()){
            return;
        }

        Geral::setMessage('Notas lançadas com sucesso.', 'success');
        return redirect()->route('inscricao.view', $Ficha->id_inscricao);
    }
}
