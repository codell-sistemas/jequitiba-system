@extends('backoffice.layouts.app')
@section('title', 'Listar Lançamentos')
@section('menu','Lançamentos')
@section('content')


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
                "ajax": "{{route('lancamento.data')}}",
                "columns": [
                    {data: 'nome', name: 'nome'},
                    {data: 'categoria', name: 'categoria'},
                    {data: 'valor', name: 'valor'},
                    {data: 'data_vencimento', name: 'data_vencimento'},
                    {data: 'baixa', name: 'baixa'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection