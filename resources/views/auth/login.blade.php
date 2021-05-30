@extends("layouts.log_reg")
@section("title","Login")
@section("content")

    <form method="POST" class="form" action="login/user">
        @csrf
        <!-- Container form -->
        <div class="container-form">
            <div class="logo">
                <h1>Pluc 2.0</h1>
            </div>

            <div class="sub-title">
                <h3>Entre</h3>
            </div>
            @if (session('erro'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('erro') }} 
            </div>
            @endif
            <!-- Box input -->
            <div class="box-input">
                <ion-icon name="mail-outline" size="small"></ion-icon>
                <input name="email" type="text" placeholder="E-mail" name="email"  value= "@if(session('email')) {{ session('email') }} @endif"  class="input-form">
            </div>
            <!-- Box input -->
            <div class="box-input">
                <ion-icon name="lock-closed-outline" size="small"></ion-icon>
                <input type="password" id="input-pass" placeholder="Senha" class="input-form" name="password">
                <ion-icon id = "icon-pass" onclick="see()" name="eye-off-outline" size="small"></ion-icon>
            </div>
            <!-- Box input -->
            <div class="box-input-button">
                <input type="submit" class="button-login" value="Entrar">
            </div>
            <!-- <a href="/forgot-password">Esqueceu sua senha?</a> -->
            <a href="/register" id = "link-regi">Criar conta</a>
        </div>
        <!-- End container form -->
    </form>
@endsection