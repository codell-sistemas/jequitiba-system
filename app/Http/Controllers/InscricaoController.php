<?php

namespace App\Http\Controllers;


use App\Ficha;
use App\Getnet;
use App\Http\Custom\Geral;
use App\Inscricao;
use App\Http\Requests\InscricaoRequest;
use App\Modalidade;
use Illuminate\Http\Request;

class InscricaoController extends Controller
{

    /*
     * Index
     */

    public function index(Request $request)
    {
        $inscricoes = [
            'INSCRIÇÃO XVII POTRO DO FUTURO 2021' => 'INSCRIÇÃO XVII POTRO DO FUTURO 2021',
            'INSCRIÇÃO XXI CAMPEONATO NACIONAL DE CONFORMAÇÃO & TRABALHO 2020' => 'INSCRIÇÃO XXI CAMPEONATO NACIONAL DE CONFORMAÇÃO & TRABALHO 2020'
        ];


        return view('inscricao.index')->with([
            'inscricoes' => $inscricoes
        ]);
    }

    /*
     * Search ASSOCIADO
     */

    public function owner(Request $request)
    {
        $term = $request->get('term');
        $json = file_get_contents('http://mk.codell.com.br/searchowner.php?term=' . urlencode($term));
        return $json;
    }

    /*
    * Search ANIMAL
    */

    public function animal(Request $request)
    {
        $term = $request->get('term');
        $json = file_get_contents('http://mk.codell.com.br/search.php?term=' . urlencode($term));
        return $json;
    }

    /*
     * Search MODALIDADE
     */

    public function modalidade(Request $request)
    {
        $term = $request->get('term');

        $modalidades = Modalidade::where('nome', 'like', '%' . $term . '%')
            ->where('tipo', $request->get('inscricao'))
            ->orderBy('nome')
            ->get()
            ->toJson();

        return $modalidades;
    }

    /*
    * Search MODALIDADE
    */

    public function modalidade_detalhe(Request $request)
    {
        $nome = $request->get('nome');

        $Modalidade = Modalidade::where('nome', $nome)->first();

        return $Modalidade->toJson();
    }

    /*
     * Calculate total
     */
    public function total(Request $request)
    {
        $preco = $request->get('preco');
        $baias = $request->get('baias');

        $total = $preco + ($baias * 21000);

        return number_format($total / 100, 2, ',', '.');
    }

    /*
    * Calculate total
    */
    public function session(Request $request)
    {
        $totals = $request->get('totals');
        $baias = $request->get('baias');
        $modalidades = $request->get('modalidades');
        $tipo = $request->get('tipo');

        $return = '';
        $total_final = 0;
        if (count($totals)) {
            foreach ($totals as $key => $total) {
                if ($total) {
                    //Modalidade
                    $Modalidade = Modalidade::where('nome', $modalidades[$key])->first();
                    $total_final += Geral::onlyNumber($total);
                    $return .= $baias[$key] . 'X - ' . $Modalidade->nome . ' - R$ ' . $total . '<hr style="border:1px dashed black;"/>';
                }
            }
        }
        return json_encode([
            'subtotal' => $return,
            'total' => 'R$ ' . Geral::moneyFormat($total_final)
        ]);

    }

    /*
     * Add Ficha
     */

    public function ficha(Request $request)
    {
        $tabButton = ' <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#md-' . $request->get('tabCount') . '" role="tab" aria-controls="contact-just" aria-selected="false">'
            . $request->get('tabCount') .
            '</a></li>';

        $inscricoes = [
            'INSCRIÇÃO XVII POTRO DO FUTURO 2021' => 'INSCRIÇÃO XVII POTRO DO FUTURO 2021',
            'INSCRIÇÃO XXI CAMPEONATO NACIONAL DE CONFORMAÇÃO & TRABALHO 2020' => 'INSCRIÇÃO XXI CAMPEONATO NACIONAL DE CONFORMAÇÃO & TRABALHO 2020'
        ];

        $tab = '<div class="tab-pane fade" id="md-' . $request->get('tabCount') . '" role="tabpanel" aria-labelledby="contact-tab-md">' .
            view()->make('inscricao.ficha')->with([
                'request' => $request->old(),
                'inscricoes' => $inscricoes
            ])->render() .
            '</div>';


        return json_encode([
            'tabButton' => $tabButton,
            'tab' => $tab
        ]);
    }


    /*
     * Salvar inscricao
     */

    public function save(InscricaoRequest $request)
    {
        //Inscrição
        $Inscricao = new Inscricao();
        $Inscricao->associado = $request->get('associado');
        $Inscricao->cpf = $request->get('cpf');
        $Inscricao->email = $request->get('email');
        $Inscricao->endereco = $request->get('endereco');
        $Inscricao->numero = $request->get('numero');
        $Inscricao->bairro = $request->get('bairro');
        $Inscricao->complemento = $request->get('complemento');
        $Inscricao->uf = $request->get('uf');
        $Inscricao->cidade = $request->get('cidade');
        $Inscricao->telefone = Geral::onlyNumber($request->get('telefone'));
        $Inscricao->whatsapp = Geral::onlyNumber($request->get('whatsapp'));
        $Inscricao->mensagem = $request->get('mensagem_adicional');
        //Totais
        $Inscricao->save();
        //Ficha
        $total_final = 0;
        $input = $request->all();
        if (count($request->get('total'))) {
            foreach ($request->get('total') as $key => $total) {
                $Ficha = new Ficha();
                $Ficha->id_inscricao = $Inscricao->id;
                $Ficha->inscricao = $input['inscricao'][$key];;
                $Ficha->nome_animal = $input['nome_animal'][$key];
                $Ficha->nome_cavaleiro = $input['nome_cavaleiro'][$key];
                $Ficha->modalidade = $input['modalidade'][$key];
                $Ficha->modalidade_preco = $input['modalidade_preco'][$key];
                $Ficha->baia_pre_moldada = $input['baia_pre_moldada'][$key];
                $Ficha->total = Geral::onlyNumber($input['total'][$key]);
                $Ficha->save();
                //SUM TOTAL
                $total_final += $Ficha->total;
            }
        }
        //Save total
        $Inscricao->total = $total_final;
        $Inscricao->update();

        //Mail
        $mail = '<center><img src="http://abcpaint.com.br/wp-content/uploads/2020/06/cropped-Logotipo_ABCPaint_300x300-1.jpg" style="width:150px;"/></center>
<h2 style="padding:10px;background:#1b3b6a;color:white;">Inscrição realizada</h2>';
        $mail .= 'Sua inscrição foi realizada com sucesso:<br/>';
        $mail .= '<br/><span style="display:block;padding:10px;border:1px dashed black;">' . $Inscricao->resumo() . '</span>';
        $mail .= '<br/><span style="display:block;color: #855d16;background-color: #fff0d5;border-color: #fff0d5;position: relative;padding: .75rem 1.25rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 4px;">
<strong>Atenção:</strong> Sua inscrição só será validada após o pagamento.</span>';
        Geral::sendMail($mail, 'Inscrição realizada!', [$Inscricao->email]);

        return redirect()->route('payment', ['id_inscricao' => base64_encode($Inscricao->id)]);
    }

    /*
     * ATualiza status
     */
    public function status(Request $request)
    {
        $Inscricao = Inscricao::find($request->get('id_inscricao'));
        $Inscricao->status = $request->get('status');
        $Inscricao->update();
        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }

    /*
     * DataTable
     */

    public function data()
    {
        $data = Inscricao::latest()->get();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('inscricao.edit', ['id' => $row->id]) . '" class="btn btn-info btn-md my-0 waves-effect waves-light">
	                           EDITAR
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-md my-0 waves-effect waves-light remover" data-url="' . route('inscricao.delete', $row->id) . '" title="Deletar">
                               EXCLUIR                
                        </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

}
