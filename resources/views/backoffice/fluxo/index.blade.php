@extends('backoffice.layouts.app')
@section('title', 'Fluxo de Caixa')
@section('menu','Lançamentos')
@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['method'=>'get','url'=>'/fluxo','class'=>'form-horizontal']) !!}
            <div class="row">
                <div class="col-sm-3">
                    &nbsp;
                </div>
                <div class="col-sm-3">
                    Tipo
                    {!! Form::select('tipo_lancamento',['previsto'=>'Previsto','baixa'=>'Realizado'],$tipo_lancamento,['class'=>'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    Período
                    <select name="ano" class="form-control">
                        <?php $anoAtual = date('Y');
                        $anoStart = $anoAtual - 3;
                        $anoEnd = $anoAtual + 3;
                        for ($anoSelect = $anoStart;
                             $anoSelect < $anoEnd;
                             $anoSelect++){ ?>
                        <option value="{{$anoSelect}}" {{$anoSelect == $ano ? 'selected' : ''}}>{{$anoSelect}}</option>
                        <?php } ?>
                    </select><br/>

                    <div style="float: right;margin-top: 10px;margin-right: 0px;">
                        {!! Form::submit('FILTRAR',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Fluxo de Caixa</h4>
            <h6 class="card-subtitle">Fluxo de caixa anual com totalização de (receitas - despesas)</h6>
            <hr/>
            <div class="">
                <?php $total = []; ?>
                <table class="table table-bordered">
                    <tr style="background: #cdcdcd;color:black;">
                        <td style="background: white;">&nbsp;</td>
                        <?php for ($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{\App\Http\Custom\Geral::mesExtenso($i).' '.$ano}}</strong></td>
                        <?php } ?>
                    </tr>
                    <tr style="background:#1b3b6a;color:white;">
                        <td><strong>(+) Entradas de Caixa</strong></td>
                        <?php for ($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{\App\Categoria::totalLancamentos('receita', $i . '/' . $ano, $baixa)}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php if (count($receitas)){
                    foreach ($receitas as $Receita){ ?>
                    <tr>
                        <td style="vertical-align: middle">{{$Receita->nome}}</td>
                            <?php for ($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            R$ {{$Receita->valorLancamentos($i.'/'.$ano,$baixa)}}
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }
                    } ?>
                    <tr style="background:#fc4b6c;color:white;">
                        <td><strong>(-) Saídas de Caixa</strong></td>
                        <?php for ($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            <strong>R$ {{\App\Categoria::totalLancamentos('despesa', $i . '/' . $ano, $baixa)}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php if (count($despesas)){
                    foreach ($despesas as $Despesa){ ?>
                    <tr>
                        <td>{{$Despesa->nome}}</td>
                            <?php for ($i = 1;$i <= 12;$i++){ ?>
                        <td style="text-align: center;">
                            R$ {{$Despesa->valorLancamentos($i.'/'.$ano,$baixa)}}
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }
                    } ?>
                    <tr style="background: #cdcdcd;color:black;">
                        <td><strong>TOTAL {{$tipo_lancamento == 'previsto' ? 'PREVISTO' : 'REALIZADO'}}</strong></td>
                        <?php for ($i = 1; $i <= 12;$i++){
                            $receitaTotal = \App\Categoria::totalLancamentos('receita',$i.'/'.$ano,$baixa,0);
                            $despesaTotal = \App\Categoria::totalLancamentos('despesa',$i.'/'.$ano,$baixa,0);

                        ?>
                        <td style="text-align: center;" title="+ {{Geral::moneyFormat($receitaTotal)}} - {{Geral::moneyFormat($despesaTotal)}}">
                            <strong>R$ {{Geral::moneyFormat($receitaTotal-$despesaTotal)}}</strong>
                        </td>
                        <?php } ?>
                    </tr>
                </table>


            </div>
        </div>
    </div>
@endsection