<?php

namespace App\Http\Controllers\Backoffice;


use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Http\Requests\AssociadoRequest;
use App\Http\Requests\AssociadoUpdateRequest;
use App\Associado;
use Illuminate\Pagination\LengthAwarePaginator;

class AssociadoController extends Controller
{

    /*
     * Index
     */

    public function index()
    {
        $term = strtoupper(request()->get('term'));


        $page = request()->has('page') ? request('page') : 1;
        $perPage = request()->has('per_page') ? request('per_page') : 100;
        $offset = ($page * $perPage) - $perPage;
        $url = "http://mk.codell.com.br/user.php";
        $newCollection = collect(json_decode(file_get_contents($url), true));


        if ($term) {
            $newCollection = $newCollection->filter(function ($item) use ($term) {
                return false !== stristr(trim($item['ASS_CH_NOME']), $term);
            });
        }

        $results = new LengthAwarePaginator(
            $newCollection->slice($offset, $perPage),
            $newCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );


        return view('backoffice.associado.index')->with([
            'data' => $results
        ]);
    }

    /*
    * View
    */

    public function view($id)
    {
        $User = json_decode(file_get_contents('http://mk.codell.com.br/userId.php?id=' . $id));
        $User = (array)$User[0];
        $financeiros = collect(json_decode(file_get_contents('http://mk.codell.com.br/financeiro.php?id=' . $id)));
        $documentos = collect(json_decode(file_get_contents('http://mk.codell.com.br/documento.php?id=' . $id)));

        return view('backoffice.associado.view')->with([
            'User' => $User,
            'financeiros' => $financeiros,
            'documentos' => $documentos
        ]);
    }

}
