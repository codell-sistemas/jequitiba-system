@extends('backoffice.layouts.app')
@section('title', 'Auditoria')
@section('menu','Auditoria')



@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Logs</h4>
            <h6 class="card-subtitle">Logs de alterações de alterações no sistema</h6>

            <div class="">

                <table class="table table-bordered">
                    <thead>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Tabela</th>
                    <th>Antes</th>
                    <th>Depois</th>
                    <th>Data</th>
                    </thead>
                    <tbody>
                    @if(count($logs))
                        @foreach($logs as $Log)
                            <tr>
                                <td>{{$Log->usuario->nome}}</td>
                                <td><b style="font-size:12px;">{{$Log->tipo}}</b></td>
                                <td>{{$Log->tabela}}</td>
                                <td>
                                    <div id="antes-{{$Log->id}}"></div>
                                </td>
                                <td>
                                    <div id="depois-{{$Log->id}}"></div>
                                </td>
                                <td>
                                    <time>
                                        <i class="fa fa-clock"></i> {{\App\Http\Custom\Geral::timeago($Log->created_at)}}
                                    </time>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <center>  {!! $logs->links() !!}</center>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/json-viewer.js"></script>
    <link rel="stylesheet" href="/css/json-viewer.css">
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
            vertical-align: middle !important;
        }

        time {
            font-size: 13px;
            border-bottom: 1px dashed #cdcdcd;
            color: gray;
        }
    </style>
    @if(count($logs))
        @foreach($logs as $Log)
            <script>
                var jsonViewer = new JSONViewer();
                var jsonAntes = {!! $Log->antes !!};
                document.querySelector("#antes-{{$Log->id}}").appendChild(jsonViewer.getContainer());
                jsonViewer.showJSON(jsonAntes, -1, -1);

                var jsonViewer = new JSONViewer();
                var jsonDepois = {!! $Log->depois !!};
                document.querySelector("#depois-{{$Log->id}}").appendChild(jsonViewer.getContainer());
                jsonViewer.showJSON(jsonDepois, -1, -1);
            </script>
        @endforeach
    @endif
@endsection