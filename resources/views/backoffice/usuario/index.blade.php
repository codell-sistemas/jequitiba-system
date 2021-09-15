@extends('backoffice.layouts.app')
@section('title', 'Listar Usuários')
@section('menu','Usuários')
@section('content')


    <div class="card">
        <div class="card-body">
            <a href="{{route('usuario.create')}}" class="btn btn-info float-right">NOVO USUÁRIO</a>
            <h4 class="card-title">Usuários</h4>
            <h6 class="card-subtitle">Listagem de usuários cadastrados</h6>

            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "info": false,
                "searching": false,
                "bLengthChange": false,
                "ajax": "{{route('usuario.data')}}",
                "columns": [
                    {data: 'nome', name: 'nome'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection