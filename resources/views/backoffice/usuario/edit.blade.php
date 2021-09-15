@extends('backoffice.layouts.app')
@section('title', 'Cadastrar Usuário')
@section('menu','Usuários')
@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cadastrar usuário</h4>
            <h6 class="card-subtitle">Insira abaixo os dados do usuário</h6>
            {!! Form::model($Usuario,['route'=>['usuario.update',['id'=>$Usuario->id]],'class'=>'mt-3']) !!}

            <div class="form-group">
                <!--Nome-->
                <label class="form-control-label">Nome</label>
                {!!Form::text('nome',null,['class'=>"form-control ".($errors->has('nome') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{ $errors->first('nome') }}</div>@endif
            <!--Nome-->
            </div>

            <div class="form-group">
                <!--Email-->
                <label class="form-control-label">Email</label>
                {!!Form::text('email',null,['class'=>"form-control ".($errors->has('email') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>@endif
            <!--Email-->
            </div>

            <!--Senha-->
            <div class="form-group">
                <label class="form-control-label">Senha</label>
                {!!Form::password('senha',['class'=>"form-control ".($errors->has('senha') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('senha'))
                    <div class="invalid-feedback">{{ $errors->first('senha') }}</div>@endif
            </div>
            <!--Senha-->

            <!--Confirmar senha-->
            <div class="form-group">
                <label class="form-control-label">Confirmar senha</label>
                {!!Form::password('confirmar_senha',['class'=>"form-control ".($errors->has('confirmar_senha') ? 'is-invalid' : '')]) !!}
                @if ($errors->has('confirmar_senha'))
                    <div class="invalid-feedback">{{ $errors->first('confirmar_senha') }}</div>@endif
            </div>
            <!--Confirmar senha-->

            <!-- Form submit -->
            <br/>
            <hr/>
            <div class="card-body">
                <div class="action-form">
                    <div class="form-group mb-0 text-left">
                        {!! Form::button('CANCELAR',['type'=>'reset','class'=>'btn btn-light waves-effect waves-light float-left']) !!}
                        {!! Form::button('SALVAR',['type'=>'submit','class'=>'btn btn-info waves-effect waves-light float-right']) !!}
                    </div>
                </div>
            </div>
            <!-- Form submit -->


            {!! Form::close() !!}
        </div>
    </div>



@endsection