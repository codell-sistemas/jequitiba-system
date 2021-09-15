@extends('backoffice.layouts.app')
@section('title', 'Listar Lançamentos')
@section('menu','Lançamentos')
@section('content')


    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Fluxo de Caixa</h4>
            <h6 class="card-subtitle">Fluxo de caixa anual com totalização de (receitas - despesas)</h6>
            <hr/>
            <div class="">

                <table class="table table-bordered">
                    <tr style="background: #cdcdcd;color:black;">
                        <td style="background: white;">&nbsp;</td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>{{\App\Http\Custom\Geral::mesExtenso($i).' '.date('Y')}}</strong></td>
                        <?php } ?>
                    </tr>
                    <tr style="background:#1b3b6a;color:white;">
                        <td><strong>(+) Entradas de Caixa</strong></td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{\App\Categoria::totalLancamentos('receita',$i.'/'.date('Y'))}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php if(count($receitas)){
                    foreach($receitas as $Receita){ ?>
                    <tr>
                        <td>{{$Receita->nome}}</td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            R$ {{$Receita->valorLancamentos($i.'/'.date('Y'))}}
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }
                    } ?>
                    <tr style="background:#fc4b6c;color:white;">
                        <td><strong>(-) Saídas de Caixa</strong></td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{\App\Categoria::totalLancamentos('despesa',$i.'/'.date('Y'))}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php if(count($despesas)){
                    foreach($despesas as $Despesa){ ?>
                    <tr>
                        <td>{{$Despesa->nome}}</td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            R$ {{$Despesa->valorLancamentos($i.'/'.date('Y'))}}
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }
                    } ?>
                    <tr style="background: #cdcdcd;color:black;">
                        <td><strong>TOTAL</strong></td>
                        <?php for($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{Geral::moneyFormat(\App\Categoria::totalLancamentos('receita',$i.'/'.date('Y'),0)-\App\Categoria::totalLancamentos('despesa',$i.'/'.date('Y'),0))}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                </table>


            </div>
        </div>
    </div>
@endsection