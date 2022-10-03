@extends('backoffice.layouts.app')
@section('title', 'Listar Lançamentos')
@section('menu','Lançamentos')
@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['method'=>'get','url'=>'/lancamento','class'=>'form-horizontal']) !!}
            <div class="row">
                <div class="col-sm-3">
                    Data
                    {!! Form::text('data',request()->get('data'),['class'=>'form-control date']) !!}
                </div>
                <div class="col-sm-3">
                    Categoria
                    <select name="id_categoria" class="form-control">
                        <option vale="">Selecione</option>
                        <?php
                        $receitas = \App\Categoria::where('tipo', 'receita')->orderBy('nome')->get();
                        if (count($receitas)){
                        foreach ($receitas as $Receita){
                            ?>
                        <option value="{{$Receita->id}}"
                                {{request()->get('id_categoria') == $Receita->id ? 'selected' : ''}}
                                style="background:#1b3b6a;color:white;">{{$Receita->nome}}</option>
                            <?php
                        }
                        }
                        $despesas = \App\Categoria::where('tipo', 'despesa')->orderBy('nome')->get();
                        if (count($despesas)){
                        foreach ($despesas as $Despesa){
                            ?>
                        <option value="{{$Despesa->id}}"
                                {{request()->get('id_categoria') == $Despesa->id ? 'selected' : ''}}
                                style="background:#fc4b6c;color:white;">{{$Despesa->nome}}</option>
                            <?php
                        }
                        } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    Descrição/Nome
                    {!! Form::text('descricao',request()->get('descricao'),['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row" style="float: right;margin-top: 10px;margin-right: 0px;">
                {!! Form::submit('FILTRAR',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{route('lancamento.create')}}" class="btn btn-info float-right">NOVO LANÇAMENTO</a>
            <h4 class="card-title">Lançamentos</h4>
            <h6 class="card-subtitle">Listagem de lançamentos cadastrados</h6>

            <div class="">
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Valor (R$)</th>
                        <th>Data Vencimento</th>
                        <th>Baixa ?</th>
                        <th>Açoes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if (count($lancamentos)){
                    foreach ($lancamentos as $Lancamento){
                        $Categoria = \App\Categoria::find($Lancamento->id_categoria);
                        $total += $Lancamento->valor;
                        ?>
                    <tr>
                        <td>{{$Lancamento->nome}}</td>
                        <td>
                                <?php
                            if ($Categoria) {
                            if ($Categoria->tipo == 'receita') { ?>
                            <span class="badge badge-primary">{{$Categoria->nome}}</span>
                            <?php } else { ?>
                            <span class="badge badge-danger">{{$Categoria->nome}}</span>
                            <?php }
                            } ?>
                        </td>
                        <td>{{\App\Http\Custom\Geral::moneyFormat($Lancamento->valor)}}</td>
                        <td>{{\App\Http\Custom\Geral::dateInput($Lancamento->data_vencimento)}}</td>
                        <td>{!! $Lancamento->baixa ? '<i class="fa fa-check green"></i> Sim' : 'Não' !!}</td>
                        <td>
                            <a href="{{route('lancamento.edit', ['id' => $Lancamento->id]) }}"
                               class="btn btn-info btn-md my-0 waves-effect waves-light">
                                EDITAR
                            </a>
                            <a href="javascript:void(0);"
                               class="btn btn-danger btn-md my-0 waves-effect waves-light remover"
                               data-url="{{route('lancamento.delete', $Lancamento->id)}}" title="Delete">
                                EXCLUIR
                            </a>
                        </td>
                    </tr>
                    <?php }
                    } ?>
                    </tbody>
                    <tfoot style="background: #ddd;">
                    <td colspan="2" class="active">
                        <b>Valor total (R$)</b>
                    </td>
                    <td colspan="4" style="text-align: left;">
                        {{\App\Http\Custom\Geral::moneyFormat($total)}}
                    </td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection