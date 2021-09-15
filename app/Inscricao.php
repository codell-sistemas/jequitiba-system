<?php

namespace App;

use App\Http\Custom\Geral;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricao';

    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'id_inscricao');
    }

    public function pagamento()
    {
        switch ($this->pagamento) {
            case 'Cartão':
                return '<span class="badge badge-warning" style="color: white;">Cartão de Crédito (GetNet)</span>';
                break;
            case 'Depósito':
                return '<span class="badge badge-info">Depósito Bancário</span>';
                break;
        }
    }

    public function status()
    {
        switch ($this->status) {
            case 'open':
                return '<span class="badge badge-secondary">Aguardando Pagamento</span>';
                break;
            case 'Pago':
                return '<span class="badge badge-primary">Pago</span>';
                break;
            case 'Fatura enviada (GetNet)':
                return '<span class="badge badge-warning" style="color: white;">Fatura enviada (GetNet)</span>';
                break;
            case 'Cancelado':
                return '<span class="badge badge-danger">Cancelado</span>';
                break;

        }
    }

    public function resumo()
    {
        $return = '<div class="card">
            <div class="card-body">';

        $fichas = $this->fichas;
        if (count($fichas)) {
            foreach ($fichas as $Ficha) {
                //Modalidade
                $Modalidade = Modalidade::where('nome', $Ficha->modalidade)->first();
                if ($Modalidade) {
                    $return .= $Ficha->baia_pre_moldada . 'X - ' . $Modalidade->nome . ' - R$ ' . Geral::moneyFormat($Ficha->total/($Ficha->baia_pre_moldada > 0 ? $Ficha->baia_pre_moldada : 1)) . '<hr style="border:1px dashed black;"/>';
                }
            }
        }
        $return .= '<h4><b>Total: R$ </b>' . Geral::moneyFormat($this->total) . '</h4>
            </div>
        </div>';

        return $return;
    }
}
