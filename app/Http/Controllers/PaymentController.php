<?php

namespace App\Http\Controllers;

use App\Inscricao;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $Inscricao = Inscricao::find(base64_decode($request->get('id_inscricao')));

        return view()->make('payment.index')->with([
            'Inscricao' => $Inscricao,
            'pagamento' => $request->get('pagamento')
        ]);
    }

    public function cartao(Request $request)
    {
        $Inscricao = Inscricao::find(base64_decode($request->get('id')));
        $Inscricao->pagamento = 'Cartão';
        $Inscricao->status = 'open';
        $Inscricao->update();

        return redirect()->route('payment', ['pagamento' => -1,'id_inscricao'=>base64_encode($Inscricao->id)]);
    }
}
