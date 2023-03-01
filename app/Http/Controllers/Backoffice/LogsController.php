<?php

namespace App\Http\Controllers\Backoffice;


use App\Http\Controllers\Controller;
use App\Http\Custom\Geral;
use App\Logs;

class LogsController extends Controller
{

    /*
     * Index
     */

    public function index()
    {
        $logs = Logs::orderBy('created_at', 'DESC')->paginate(10);


        return view('backoffice.auditoria.index')->with(['logs' => $logs]);
    }

}
