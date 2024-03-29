<?php

namespace App\Http\Custom;

use App\Estabelecimento;
use Faker\Provider\DateTime;
use Mockery\Exception;

class Geral
{

    public static function setMessage($message, $type = 'success')
    {
        $session = [
            'message' => $message,
            'type' => $type
        ];
        \Session::push('message', $session);
    }

    public static function mesExtenso($mes)
    {
        switch ($mes) {
            case 1:
                return 'Jan';
                break;
            case 2:
                return 'Fev';
                break;
            case 3:
                return 'Mar';
                break;
            case 4:
                return 'Abr';
                break;
            case 5:
                return 'Mai';
                break;
            case 6:
                return 'Jun';
                break;
            case 7:
                return 'Jul';
                break;
            case 8:
                return 'Ago';
                break;
            case 9:
                return 'Set';
                break;
            case 10:
                return 'Out';
                break;
            case 11:
                return 'Nov';
                break;
            case 12:
                return 'Dez';
                break;

        }
    }

    public static function mascara($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public static function telefone($phone)
    {
        $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
        if ($matches) {
            return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
        }

        return $phone; // return number without format
    }

    public static function semanaExtenso($dia)
    {
        $semana = [
            0 => 'domingo',
            1 => 'segunda-feira',
            2 => 'terça-feira',
            3 => 'quarta-feira',
            4 => 'quinta-feira',
            5 => 'sexta-feira',
            6 => 'sábado'
        ];

        return $semana[$dia];
    }

    public static function onlyNumber($str)
    {
        return preg_replace('/\D/', '', $str);
    }

    public static function moneyFormat($str)
    {
        return number_format($str / 100, 2, ",", ".");
    }

    public static function requestOld($request, $field, $id)
    {
        $return = [];
        if (count($request)) {
            $return = array_key_exists($field, $request) && array_key_exists($id, $request[$field]) ? [$request[$field][$id] => $request[$field][$id]] : [];
        }
        return $return;
    }

    public static function dateInput($date)
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    /*
     * SEND EMAIL
     * @string text
     * @string subject
     * @array to
     */

    public static function sendMail($text, $subject, $to = [])
    {
        try {
            $mail = \Mail::send([], [], function ($message) use ($text, $subject, $to) {
                $message->to($to)
                    ->subject($subject)
                    ->setBody($text, 'text/html');
            });
            return $mail;
        } catch (\Swift_TransportException $e) {

        }
        return null;
    }
}