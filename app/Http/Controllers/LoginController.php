<?php

namespace App\Http\Controllers;


use App\Http\Custom\Geral;
use App\Http\Requests\LoginRequest;
use App\Usuario;

class LoginController extends Controller
{

    /*
     * Index
     */

    public function login()
    {
        if (\Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login')->with([
        ]);
    }


    /*
     * AUTH - dev
     */

    public function logar(LoginRequest $request)
    {
        $Usuario = Usuario::where('email', $request->email)->where('senha', md5($request->senha))->first();
        if (!$Usuario) {
            Geral::setMessage('Email e/ou senha inválidos.', 'danger');
            return redirect()->back();
        }

        \Auth::login($Usuario);

        Geral::setMessage('Seja Bem-Vindo <b>' . $Usuario->nome . '.</b>');
        return redirect()->route('dashboard');
    }

    /*
     * Logout
     */

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }
}
