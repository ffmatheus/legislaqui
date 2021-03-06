<!-- Fixed navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--{{ Html::image(('img/alerj.png'), null, array( 'width' => 70, 'height' => 70 )) }}--}}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {{--<a class="navbar-brand" href="/">e-Cidadania</a>--}}
            <ul class="nav navbar-nav">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                {{--<li class="{{ set_menu_active('/') }}"><a href="/">Início</a></li>--}}
                {{--<li {{ Request::is('/') ? ' class=active' : null }}><a href="/">Home</a></li>--}}
                {{--<li>{{ Html::linkRoute('proposals', 'Home')}}</li>--}}
                <li class="{{ set_menu_active('about') }}"><a href="/about">Como Funciona?</a></li>
                {{--<li {{ Request::is('about') ? ' class=active' : null }}><a href="/about">Como Funciona?</a></li>--}}
                {{--<li>{{ Html::link('about', 'Como Funciona?')}}</li>--}}

                {{--<li {{ Request::is('contact') ? ' class=active' : null }}><a href="/contact">Contato</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">IDEIA LEGISLATIVA <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::guest())
                            <li><div><a href="{{ route('proposal.create') }}">Proponha uma ideia legislativa logando ou registrando-se aqui</a></div></li>
                            {{--url('/login') }}">Proponha uma ideia legislativa<br>logando/registrando-se aqui</a></li>--}}
                            <li role="separator" class="divider"></li>
                            <li><div><a href="{{ route('terms') }}">Termos de Uso</a></div></li>
                            {{--<li class="dropdown-header">ALERJ</li>--}}
                        @elseif (Auth::user()->is_admin)
                            {{--@elseif (Auth::user()->role_id === 0 or Auth::user()->role_id === 1)--}}
                            <a href="{{ route('admin') }}">Ir ao Painel de Admin</a>
                            <a href="{{ route('proposal.create') }}">Incluir Nova Proposta</a>
                            <a href="{{ route('users.proposals', Auth::user()->id) }}">Listar Minhas Propostas</a>
                            {{--<a href="{{ route('users.responses', Auth::user()->id) }}">Listar Minhas Respostas</a>--}}
                            {{--<a href="{{ route('proposals.notresponded') }}">Sem Resposta</a>--}}
                        @else
                            <a href="{{ route('proposal.create') }}">Incluir Nova Proposta</a>
                            <a href="{{ route('users.proposals', Auth::user()->id) }}">Listar Minhas Propostas</a>
                        @endif
                    </ul>
                </li>

                <li class="{{ set_menu_active('contact') }}"><a href="/contact">Contato</a></li>

                <!-- Authentication Links -->

                @if (Auth::guest())
                    <li class="{{ set_menu_active('login') }}"><a href="{{ url('/login') }}">Login | Registro</a></li>
                    {{--<li><a href="{{ url('/register') }}">Registro</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::user()->is_admin)
                            <a href="{{ route('admin') }}">Ir ao Painel de Admin</a>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="detalhe"></div>
        </div><!--/.nav-collapse -->
    </div><!-- /.container-fluid -->
</nav>