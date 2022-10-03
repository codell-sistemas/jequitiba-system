@extends('backoffice.layouts.app')
@section('title', 'Cadastrar Lançamento')
@section('description','Lançamentos')
@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cadastrar lançamento</h4>

        </div>
    </div>

    {!! Form::open(['route'=>'lancamento.save'],['class'=>'form-material mt-4']) !!}
    <div class="card">
        <div class="card-body">
            <h6 class="card-subtitle">Insira abaixo os <code>dados</code> do lançamento</h6>
            <hr/>
            <!--Nome-->
            <div class="form-group">
                <label class="form-control-label">Nome</label>
                {!!Form::text('nome',null,['class'=>"form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                @endif
            </div>
            <!--Nome-->

            <!-- Categoira-->
            <div class="form-group">
                <label class="form-control-label">Categoria</label>
                <select name="id_categoria" class="form-control" style="width:350px;">
                    <option value="">Selecione</option>
                    <?php
                    $receitas = \App\Categoria::where('tipo', 'receita')->orderBy('nome')->get();
                    if (count($receitas)){
                    foreach ($receitas as $Receita){
                        ?>
                    <option value="{{$Receita->id}}" style="background:#1b3b6a;color:white;">{{$Receita->nome}}</option>
                        <?php
                    }
                    }
                    $despesas = \App\Categoria::where('tipo', 'despesa')->orderBy('nome')->get();
                    if (count($despesas)){
                    foreach ($despesas as $Despesa){
                        ?>
                    <option value="{{$Despesa->id}}" style="background:#fc4b6c;color:white;">{{$Despesa->nome}}</option>
                        <?php
                    }
                    } ?>
                </select>
                @if ($errors->has('id_categoria'))
                    <div class="invalid-feedback">{{ $errors->first('id_categoria') }}</div>
                @endif
            </div>
            <!-- Categoria -->

            <!--Valor-->
            <div class="form-group">
                <label class="form-control-label">Valor</label>
                {!! Form::text('valor',null,['style'=>'width:200px','class'=>"money form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('valor'))
                    <div class="invalid-feedback">{{ $errors->first('valor') }}</div>
                @endif
            </div>
            <!--Valor-->

            <!--Data vencimento-->
            <div class="form-group">
                <label class="form-control-label">Data vencimento</label>
                {!! Form::text('data_vencimento',null,['style'=>'width:150px;','class'=>"date form-control ".($errors->has('data_vencimento') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('data_vencimento'))
                    <div class="invalid-feedback">{{ $errors->first('data_vencimento') }}</div>
                @endif
            </div>
            <!--Data vencimento-->

            <!--Repetir-->
            <div class="form-group">
                <label class="form-control-label" for="repetir">Repetir</label>
                {!! Form::checkbox('repetir',1,null,['id'=>'repetir']) !!}
                <div id="div-repetir" class="row" style="{{request()->old('repetir') ? '' :'display: none;'}}">
                    <div class="col-sm-1">
                        {!! Form::number('repetir_vezes',null,['min'=>1,'class'=>'form-control '.($errors->has('repetir_vezes') ? 'is-invalid' : '')]) !!}
                    </div>
                    <strong class="col-sm-3" style="padding-top:7px">vezes</strong>
                </div>
            </div>
            <!--Repetir-->

            <!-- Baixa -->
            <div class="form-group">
                <label class="form-control-label" for="baixa">Baixa</label>
                {!! Form::checkbox('baixa',1,null) !!}
                @if ($errors->has('baixa'))
                    <div class="invalid-feedback">{{ $errors->first('baixa') }}</div>
                @endif
            </div>

            <!-- Form submit -->
            <div class="card-body">
                <div class="action-form">
                    <div class="form-group mb-0 text-left">
                        {!! Form::button('CANCELAR',['type'=>'reset','class'=>'btn btn-light waves-effect waves-light float-left']) !!}
                        {!! Form::button('SALVAR',['type'=>'submit','class'=>'btn btn-info waves-effect waves-light float-right']) !!}
                    </div>
                </div>
            </div>
            <!-- Form submit -->

        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(function(){
           $('#repetir').click(function(){
             $('#div-repetir').toggle();
           });
        });
    </script>
@endsection