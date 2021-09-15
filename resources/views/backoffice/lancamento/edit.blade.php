@extends('backoffice.layouts.app')
@section('title', 'Alterar Lançamento')
@section('description','Lançamentos')
@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar lançamento</h4>

        </div>
    </div>

    {!! Form::model($Lancamento,['route'=>['lancamento.update',$Lancamento->id]],['class'=>'form-material mt-4']) !!}
    <div class="card">
        <div class="card-body">
            <h6 class="card-subtitle">Insira abaixo os <code>dados</code> do lançamento</h6>
            <hr/>
            <!--Nome-->
            <div class="form-group">
                <label class="form-control-label">Nome</label>
                {!!Form::text('nome',null,['class'=>"form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{ $errors->first('nome') }}</div>@endif
            </div>
            <!--Nome-->

            <!-- Categoira-->
            <div class="form-group">
                <label class="form-control-label">Categoria</label>
                {!! Form::select('id_categoria',\App\Categoria::orderBy('nome')->pluck('nome','id'),null,['class'=>'form-control']) !!}
                @if ($errors->has('id_categoria'))
                    <div class="invalid-feedback">{{ $errors->first('id_categoria') }}</div>@endif
            </div>
            <!-- Categoria -->

            <!--Valor-->
            <div class="form-group">
                <label class="form-control-label">Valor</label>
                {!! Form::text('valor',null,['class'=>"money form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('valor'))
                    <div class="invalid-feedback">{{ $errors->first('valor') }}</div>@endif
            </div>
            <!--Valor-->

            <!--Data vencimento-->
            <div class="form-group">
                <label class="form-control-label">Data vencimento</label>
                {!! Form::text('data_vencimento',null,['class'=>"date form-control ".($errors->has('data_vencimento') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('data_vencimento'))
                    <div class="invalid-feedback">{{ $errors->first('data_vencimento') }}</div>@endif
            </div>
            <!--Data vencimento-->

            <!-- Baixa -->
            <div class="form-group">
                <label class="form-control-label" for="baixa">Baixa</label>
                {!! Form::checkbox('baixa',1,null) !!}
                @if ($errors->has('baixa'))
                    <div class="invalid-feedback">{{ $errors->first('baixa') }}</div>@endif
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