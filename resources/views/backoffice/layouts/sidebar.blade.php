<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i>
            <span class="hide-menu">Financeiro</span></li>

        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{route('lancamento.grid',['tipo'=>'receita'])}}" aria-expanded="false"><i
                        class="mdi mdi-grid"></i><span
                        class="hide-menu">Grid</span></a></li>

        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{route('categoria.index')}}" aria-expanded="false"><i
                        class="mdi mdi-folder"></i><span
                        class="hide-menu">Categorias</span></a></li>

        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{route('lancamento.index')}}" aria-expanded="false"><i
                        class="mdi mdi-note-multiple"></i><span
                        class="hide-menu">Lançamentos</span></a></li>

        <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{route('fluxo.index')}}" aria-expanded="false"><i
                        class="mdi mdi-chart-line"></i><span
                        class="hide-menu">Fluxo de Caixa</span></a></li>


        @if(Auth::user()->id == 1)
            <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i>
                <span class="hide-menu">Configurações</span></li>
            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark"
                                        href="{{route('usuario.index')}}" aria-expanded="false"><i
                            class="mdi mdi-account-key"></i><span
                            class="hide-menu">Usuários </span></a>
            </li>

            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark"
                                        href="{{route('logs.index')}}" aria-expanded="false"><i
                            class="mdi mdi-eye"></i><span
                            class="hide-menu">Auditoria </span></a>
            </li>
        @endif
    </ul>
</nav>
