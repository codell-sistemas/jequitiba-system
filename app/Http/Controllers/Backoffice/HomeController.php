<?php

namespace App\Http\Controllers\Backoffice;


use App\Ficha;
use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Proengsoft\JsValidation\JsValidationServiceProvider;

class HomeController extends Controller
{
    public function index()
    {
        // $ranking1 = Ficha::rankingTempo();
        return view('backoffice.dashboard.index')->with([
        ]);
    }

}
