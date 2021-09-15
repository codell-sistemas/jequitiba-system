@extends('backoffice.layouts.app')
@section('title', 'Listar Categorias')
@section('menu','Categorias')
@section('content')


    <div class="card">
        <div class="card-body">
            <a href="{{route('categoria.create')}}" class="btn btn-info float-right">NOVO CATEGORIA</a>
            <h4 class="card-title">Categorias</h4>
            <h6 class="card-subtitle">Listagem de categorias cadastradas</h6>

            <div class="">
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Açoes</th>
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
                "ajax": "{{route('categoria.data')}}",
                "columns": [
                    {data: 'nome', name: 'nome'},
                    {data: 'tipo', name: 'tipo'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection