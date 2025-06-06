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

        <div class='full-content'>
            <nav class="navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="/img/san7.jpg" alt="Sancet">
                        <span id="navbar-return">Sancet</span>
                    </a>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/pets/create" class="nav-link"><ion-icon name="paw-outline"></ion-icon> Cadastrar Pet</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="create-outline"></ion-icon> Agendar Consulta</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="receipt-outline"></ion-icon> Meus Pets</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="calendar-outline"></ion-icon> Minhas Consultas</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="log-in-outline"></ion-icon> Entrar</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="person-add-outline"></ion-icon> Cadastrar</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="main-content">

            @if(session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif

            @yield('content')
            
            </main>

        </div>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>