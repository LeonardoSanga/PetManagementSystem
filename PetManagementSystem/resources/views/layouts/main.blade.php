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
                        @auth
                        @if(auth()->user()->user_type == 1)
                        <li class="nav-item">
                            <a href="/users" class="nav-link"><ion-icon name="people-outline"></ion-icon> Usuários</a>
                        </li>
                        @endif
                        @endauth

                        <li class="nav-item">
                            <a href="/pets/create" class="nav-link"><ion-icon name="paw-outline"></ion-icon> Cadastrar Pet</a>
                        </li>

                        <li class="nav-item">
                            <a href="/appointment/create" class="nav-link"><ion-icon name="create-outline"></ion-icon> Agendar Consulta</a>
                        </li>

                    @auth 
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link"><ion-icon name="receipt-outline"></ion-icon> Meus Pets</a>
                        </li>

                        <li class="nav-item">
                            <a href="/" class="nav-link"><ion-icon name="calendar-outline"></ion-icon> Minhas Consultas</a>
                        </li>

                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf 
                                <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();"><ion-icon name="log-out-outline"></ion-icon> Sair</a>
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
                    </ul>
                    @endguest
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