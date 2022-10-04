@extends('backoffice.layouts.app')
@section('title', 'Listar Lançamentos')
@section('menu','Grid Lançamentos')
@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['method'=>'get','url'=>request()->url(),'class'=>'form-horizontal']) !!}
            <div class="row">
                <div class="col-sm-3">
                    &nbsp;
                </div>
                <div class="col-sm-3">
                    Tipo
                    {!! Form::select('tipo',['previsto'=>'Previsto','baixa'=>'Baixa'],$tipo,['class'=>'form-control']) !!}
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

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{$tipo == 'receita' ? 'active' : ''}}" id="receitas-tab"
                       href="/lancamento/receita/grid?{{http_build_query(request()->all())}}"
                       aria-selected="true"><span class="badge badge-primary">Receitas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$tipo == 'despesa' ? 'active' : ''}}" id="despesas-tab"
                       href="/lancamento/despesa/grid?{{http_build_query(request()->all())}}"
                       aria-selected="false"><span class="badge badge-danger">Despesas</span></a>
                </li>
            </ul>

            <div class="table-lancamentos">
                <table class="table table-bordered dataTable">
                    <?php
                    $total = 0;
                    if (count($categorias)){
                    foreach ($categorias as $Categoria){
                        $lancamentos = $Categoria->lancamentos()->where(DB::raw('YEAR(data_vencimento)'), $ano)->get();
                        ?>
                    <tr style="background: rgba(0, 0, 0, .05);">
                        <th colspan="2" style="text-align: left;">
                            {{$Categoria->nome}}
                        </th>
                    </tr>
                        <?php if (count($lancamentos)){
                    foreach ($lancamentos as $Lancamento){
                        $total += $Categoria->tipo == 'receita' ? $Lancamento->valor : $Lancamento->valor * (-1);
                        ?>
                    <tr>
                        <td>{{$Lancamento->nome}}</td>
                        <td>R$ {{\App\Http\Custom\Geral::moneyFormat($Lancamento->valor)}}</td>
                    </tr>
                    <?php }
                    } ?>
                    <tr style="background: rgba(0, 0, 0, .05);">
                        <th><strong>TOTAL</strong></th>
                        <th>R$ {{\App\Http\Custom\Geral::moneyFormat($total)}}</th>
                    </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
    </div>
@endsection