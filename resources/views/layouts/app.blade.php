<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Site')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilo adicional para fixar header/footer e ajustar o conteúdo --}}
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* HEADER FIXO NO TOPO */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background-color: #0d6efd; /* Azul Bootstrap */
        }

        header .navbar-brand,
        header .nav-link {
            color: #fff !important;
        }

        header .nav-link:hover {
            text-decoration: underline;
        }

        /* ÁREA DO CONTEÚDO */
        .content-wrapper {
            flex: 1;
            padding-top: 80px;   /* espaço para o header */
            padding-bottom: 70px; /* espaço para o footer */
        }

        /* FOOTER FIXO */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #0d6efd; /* Azul Bootstrap */
            color: #fff;
            z-index: 1030;
        }
    </style>
</head>
<body>

    {{-- HEADER FIXO --}}
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand fw-bold" href="{{ route('home') }}">Sistema de Gestão de Estoque</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    @if (!Request::is('login'))
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">

                                {{-- Se o usuário NÃO estiver logado --}}
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                    </li>
                                @endguest

                                {{-- Se o usuário ESTIVER logado --}}
                                @auth
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="nav-link btn btn-link text-decoration-none">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @endauth

                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
        </header>

    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="content-wrapper container my-4">
        @yield('content')
    </div>

    {{-- FOOTER FIXO --}}
    <footer class="text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} - Sistema de Gestão de Estoque. Todos os direitos reservados.</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
