
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/input.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }} 
            </div>
        @endif
        <form method="POST" class="form"action="/register/user">
            @csrf
            <!-- Container form -->
            <div class="container-form">
                <div class="logo">
                    <h1>Pluc 2.0</h1>
                </div>
                <div class="sub-title">
                    <h3>Crie sua conta</h3>                
                @if (session('erroName'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('erroName') }} 
                </div>
                @endif
                @if (session('erroEmail'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('erroEmail') }} 
                </div>
                @endif
                @if (session('passErro'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('passErro') }} 
                </div>
                @endif
                </div>
                <!-- Box input -->
                <div class="box-input">

                    <ion-icon name="person-outline" size="small"></ion-icon>
                    <input  type="text" placeholder="Apelido" name="name"  value= "@if(session('name')) {{ session('name') }} @endif"class="input-form">
                </div>
                <!-- Box input -->
                <div class="box-input">

                    <ion-icon name="mail-outline" size="small"></ion-icon>
                    <input name="email" type="text" placeholder="E-mail" value= "@if(session('email')) {{ session('email') }} @endif" name="email"  class="input-form">
                </div>
                <!-- Box input -->
                <div class="box-input">
               
                    <ion-icon name="lock-closed-outline" size="small"></ion-icon>
                    <input type="password" id="input-pass" placeholder="Senha" class="input-form" name="password">
                    <ion-icon id = "icon-pass" onclick="see()" name="eye-off-outline" size="small"></ion-icon>
                </div>
                <div class="box-input">
                    <ion-icon name="lock-closed-outline" size="small"></ion-icon>
                    <input type="password" id="input-pass" placeholder="Confirme sua senha" class="input-form" name="password_confirmation">
                </div>
                <!-- Box input -->
                <div class="box-input-button">
                    <input type="submit" class="button-login" value="Criar conta">
                </div>
                <!-- <a href="/forgot-password">Esqueceu sua senha?</a> -->
                <a href="/login" id = "link-regi">Já tem uma conta?</a>
            </div>
            <!-- End container form -->
        </form>
    </div>
</body>
</html>
