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

    public function mail()
    {
        $mail = new PHPMailer();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.zoho.com"; // SMTP server
        $mail->From = 'williamcastro@codell.com.br';
        $mail->SMTPSecure = "ssl";
        $mail->CharSet = 'UTF-8';
        $mail->Username = "williamcastro@codell.com.br"; //account with which you want to send mail. Or use this account. i dont care :-P
        $mail->Password = "wlmctr09"; //this account's password.
        $mail->Port = "465";
        $mail->isSMTP();  // telling the class to use SMTP
        $rec1="williamcastro@codell.com.br"; //receiver. email addresses to which u want to send the mail.
        $mail->AddAddress($rec1);
        $rec2="ti@jequitibacomunicacao.com.br";
        $mail->AddAddress($rec2);
        $rec3="revistapaint@gmail.com";
        $mail->addAddress($rec3);
        $mail->Subject  = "{ABCPaint} StudBook OFFLINE";
        $mail->Body     = "<strong>Atenção!!</strong> StudBook da <b>ABCPaint</b> não está acessível no momento. Clique <a href='http://abcpaint.com.br/studbook'>aqui</a> para verificar.<br/><br/><br/>".date('d/m/Y H:i:s');
        $mail->isHTML(true);
        $mail->WordWrap = 200;
        if(!$mail->Send()) {
            echo 'Message was not sent!.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
          die('Administradores notificados via email.');
        }
        die();
    }

}
