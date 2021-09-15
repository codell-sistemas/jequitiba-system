<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function cep(Request $request)
    {
        $cep = $request->get('term');

        $json = file_get_contents('http://viacep.com.br/ws/' . $cep . '/json');
        $data = json_decode($json);

        return $json;
    }
}
