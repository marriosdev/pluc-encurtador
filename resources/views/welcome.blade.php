@extends("layouts.base")
@section("title", "Pluc")
@section("content")
    <div class="container-form">
        <div>
            <h1>Encurte seus links aqui</h1>
        </div>
        <br>
        <div >
            <form action="/link" method="post">
                @csrf
                <div class="input-group">
                    @if( session())
                        <p style="color: red; font-size: 13pt;">{{ session("erro_link") }}</p>
                    @endif
                    <input class="item-form-input" type="text" name = "link" placeholder="Cole seu link" required>
                    <BR></BR>
                    @if( session())
                        <p style="color: red; font-size: 13pt;">{{ session("erro_perso") }}</p>
                    @endif
                    <input class="item-form-input" type="text" name = "perso_link" placeholder="Personalize seu link. Ex: passaros">
                    <input class="item-form-button" type="submit" value="Encurtar">
                </div>
            </form>
        </div>
    </div>
    <section class="section-second">
        @auth
            <a href="/dashboard"><button class="button"><ion-icon name="link-outline"></ion-icon>Meu links</button></a>
        @endauth
        @guest  
        <!-- GRUPO DE BOTÕES -->
        <h3>Para gerenciar seus links</h3>
        <br>
        <div class="button-group">
            <a href="/login"><button class="button"><ion-icon name="log-in-outline"></ion-icon>Entre</button></a> 
            <p>ou</p>
            <a href="/register"><button class="button"><ion-icon name="log-in-outline"></ion-icon>Cadastre-se</button></a> 
        </div>
        @endguest
    </section>
    <!-- <section class="block-links">
    <h2><ion-icon name="ribbon-outline"></ion-icon>Ranking </h2>
    <br>
    <table class="table-body">
        <tr class="title-table">
            <th></th>
            <th>#Link</th>
            <th class="none-mobile">#Acessos</th>
        </tr>
        @foreach($links as $link)
            <tr class="t-body">
                <td> <a href="/{{ $link->link_encurt }}" target="_blank"><ion-icon name="open-outline"></ion-icon></ion-icon></a></td>
                <td class="data-table">{{ $link->link_encurt }}</td>
                <td class="data-table link-table none-mobile">{{ $link->clicks }}</td>
            </tr>
        @endforeach
    </table>
</section> -->

@endsection
