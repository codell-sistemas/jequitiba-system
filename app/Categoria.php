<?php

namespace App;

use App\Http\Custom\Geral;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = [
        'nome', 'tipo'
    ];

    public function valorLancamentos($date,$baixa=0)
    {
        $data = explode('/', $date);
        $mes = $data[0];
        $ano = $data[1];

        $valor = Lancamento::where('id_categoria', $this->id)
            ->where('baixa',$baixa)
            ->where(\DB::raw('MONTH(data_vencimento)'), $mes)
            ->where(\DB::raw('YEAR(data_vencimento)'), $ano)
            ->sum('valor');

        return Geral::moneyFormat($valor);
    }

    public static function totalLancamentos($tipo,$date,$baixa,$moneyFormat=1){
        $data = explode('/', $date);
        $mes = $data[0];
        $ano = $data[1];

        $valor = Lancamento::join('categoria','categoria.id','=','lancamento.id_categoria')
            ->where('categoria.tipo',$tipo)
            ->where(\DB::raw('MONTH(lancamento.data_vencimento)'), $mes)
            ->where(\DB::raw('YEAR(lancamento.data_vencimento)'), $ano)
            ->where('baixa',$baixa)
            ->groupBy('lancamento.id')
            ->sum('valor');

        if($moneyFormat) {
            return Geral::moneyFormat($valor);
        }else{
            return $valor;
        }
    }
}
