<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/info.css">
    <script src="/js/input.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <title>@yield("title")</title>
</head>
<body>
    <div class="header">
        <!-- Navbar -->
        <ion-icon id="button-mobile-menu" onclick="open_menu()" name="menu-outline"></ion-icon>
        <a href="/" class="logo-mobile">Pluto2.0</a>
        <nav class="navbar" id="navbar-menu" name="close">
            <!-- Items -->
            <ul class="menu">
                <a href="/"><h3 class="logo ">Pluc</h3></a>
                <li class="item-nav">
                    <a href="/" class="link-nav">
                    <ion-icon name="home-outline">
                    </ion-icon>Início
                    </a>
                </li>
                @auth
                <li class="item-nav">
                    <a href="/dashboard" class="link-nav">
                    <ion-icon name="link-outline"></ion-icon>
                    Meus links</a>
                </li>
                @endauth
                @guest
                <li class="item-nav">
                    <a href="/login" class="link-nav">
                        <ion-icon name="enter-outline"></ion-icon>
                        Entrar 
                    </a>
                </li>
                @endguest
            </ul>
            <!-- LOG USER -->
            <ul class="menu" >
                @auth
                <li class="item-nav">
                    <p class="user-button link-nav">
                    <ion-icon name="person-outline">
                    </ion-icon> {{ $user->name }} 
                </p>
                </li>
            </ul>
            <form action="/logout" class="button-exit-div" method="post">
                @csrf
                    <li class="item-nav">
                        <a href="/logout" class="link-nav button-exit" onclick="event.preventDefault();
                        this.closest('form').submit()">
                        <ion-icon name="exit-outline"></ion-icon>
                        Sair
                        </a>
                    </li>
            </form>
            @endauth
        </nav>
    </div>
    <div class="container-main">
        @yield("content")
    </div>
    <div class="footer">
        <div class="icons-footer">
            <a href="https://github.com"    target="_blank"><ion-icon name="logo-octocat"></ion-icon></a> 
            <a href="https://instagram.com" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
            <a href="https://linkedin.com"  target="_blank"><ion-icon name="logo-linkedin"></ion-icon></a>           
        </div>
        <div class="content-footer">
            <p>&copy;Todos os direitos reservados @php echo date("Y") @endphp.</p>
        </div>
    </div>
</body>
</html>