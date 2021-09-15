@extends('backoffice.layouts.app')
@section('title', 'Alterar Categoria')
@section('description','Categorias')
@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar categoria</h4>

        </div>
    </div>

    {!! Form::model($Categoria,['route'=>['categoria.update',['id'=>$Categoria->id]]],['class'=>'form-material mt-4','file'=>1]) !!}
    <div class="card">
        <div class="card-body">
            <h6 class="card-subtitle">Insira abaixo os <code>dados</code> da categoria</h6>
            <hr/>
            <!--Nome-->
            <div class="form-group">
                <label class="form-control-label">Nome</label>
                {!!Form::text('nome',null,['class'=>"form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{ $errors->first('nome') }}</div>@endif
            </div>
            <!--Nome-->

            <!--Tipo-->
            <div class="form-group">
                <label class="form-control-label">Tipo</label>
                {!! Form::select('tipo',['receita'=>'Receita','despesa'=>'Despesa'],null,['class'=>'form-control']) !!}
                @if ($errors->has('tipo'))
                    <div class="invalid-feedback">{{ $errors->first('tipo') }}</div>@endif
            </div>
            <!--Tipo-->

            <hr/>
            <br/><br/>
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