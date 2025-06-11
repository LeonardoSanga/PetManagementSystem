<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fontes do Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>
</head>

<body>

    <div class="page-wrapper">

        <aside class="sidebar">
            <nav class="navbar-expand-lg navbar-light">
                <a href="/" class="navbar-brand text-center my-3">
                    <img src="/img/san7.jpg" alt="Sancet" class="sidebar-logo">
                    <span id="navbar-return">Sancet</span>
                </a>

                <ul class="navbar-nav flex-column">
                    @auth
                    @if(auth()->user()->user_type == 1)
                    <li class="nav-item">
                        <a href="/users" class="nav-link"><ion-icon name="people-outline"></ion-icon> Usuários</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link"><ion-icon name="paw-outline"></ion-icon> Meus PETs</a>
                    </li>

                    <li class="nav-item">
                        <a href="/appointment/dashboard" class="nav-link"><ion-icon name="calendar-outline"></ion-icon> Consultas</a>
                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="nav-link nav-link-logout" onclick="event.preventDefault(); this.closest('form').submit();">
                                <ion-icon name="log-out-outline"></ion-icon> Sair
                            </a>
                        </form>
                    </li>
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a href="/login" class="nav-link"><ion-icon name="log-in-outline"></ion-icon> Entrar</a>
                    </li>

                    <li class="nav-item">
                        <a href="/register" class="nav-link"><ion-icon name="person-add-outline"></ion-icon> Cadastrar</a>
                    </li>
                    @endguest
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="container-fluid"> @if(session('msg'))
                <div class="alert alert-success msg">
                    {{ session('msg') }}
                </div>
                @endif

                @yield('content')
            </div>
        </main>

    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>