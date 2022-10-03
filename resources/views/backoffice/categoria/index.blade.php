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

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="receitas-tab" data-toggle="tab" href="#receitas" role="tab"
                           aria-selected="true"><span class="badge badge-primary">Receitas</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="despesas-tab" data-toggle="tab" href="#despesas" role="tab"
                           aria-selected="false"><span class="badge badge-danger">Despesas</span></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="receitas" role="tabpanel" aria-labelledby="receitas">
                        <table class="table table-bordered" id="table-receitas">
                            <thead>
                            <tr>
                                <th style="width: 80%;">Nome</th>
                                <th>Açoes</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="despesas" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-bordered" id="table-despesas"
                               style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width: 80%;">Nome</th>
                                <th>Açoes</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .dataTables_wrapper{
            margin-top: -7px !important;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $('#table-receitas').DataTable({
                "processing": true,
                "serverSide": true,
                "info": false,
                "searching": false,
                "bLengthChange": false,
                "ajax": "{{route('categoria.data')}}?tipo=receita",
                "columns": [
                    {data: 'nome', name: 'nome'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#table-despesas').DataTable({
                "processing": true,
                "serverSide": true,
                "info": false,
                "searching": false,
                "bLengthChange": false,
                "ajax": "{{route('categoria.data')}}?tipo=despesa",
                "columns": [
                    {data: 'nome', name: 'nome'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    <style>
        table {
            margin: 0 auto;
            width: 100%;
            clear: both;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }
        .sorting_1{
            width: 80% !Important;
        }
    </style>
@endsection