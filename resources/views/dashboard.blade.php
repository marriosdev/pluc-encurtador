@extends("layouts.base")
@section("title", "Dashboard")
@section("content")
        
        <section class="block-dashboard">

            <div> 
            <h1 style="text-align:center; margin-top:3rem"><ion-icon name="attach-outline"></ion-icon>Informações</h1>
                <div class="quad-block">
                    <!-- QUAD -->
                    <div class="quad all">
                        <!-- HEADER QUAD -->
                        <div class="header-quad">
                            <p class="title-quad">Total</p>
                            <ion-icon name="link-outline"></ion-icon>
                        </div>
                        <div class="body-quad">
                            <p class="data-quad">{{ $count }}</p>
                        </div>
                    </div>
                    <!-- QUAD -->
                    <div class="quad new">
                        <!-- HEADER QUAD -->
                        <div class="header-quad">
                            <p class="title-quad">Hoje</p>
                            <ion-icon name="chevron-up-outline"></ion-icon>
                        </div>
                        <div class="body-quad">
                            <p class="data-quad">{{ $today }}</p>
                        </div>
                    </div>           
                    <div class="quad clicks">
                        <!-- HEADER QUAD -->
                        <div class="header-quad">
                            <p class="title-quad">Clicks</p>
                            <ion-icon name="open-outline"></ion-icon>                        
                        </div>
                        <div class="body-quad">
                            <p class="data-quad">{{ $clicks }}</p>
                        </div>
                    </div>         
                </div>
            </div>  
        </section>

        <section class="block-links">
        <h2><ion-icon name="checkbox-outline"></ion-icon>Seus links</h2>
        <br>
        @if($count < 1)
            <h3>Nada de links por aqui ¯\_(ツ)_/¯</h3>
        @endif
        @if($count > 0)
        <table class="table-body">
            <tr class="title-table">
                <th></th>
                <th class="none-mobile"></th>
                <th>Link</th>
                <th class="none-mobile">Acessos</th>
                <th></th>
            </tr>
                @foreach($links as $link)
                    <tr class="t-body">
                        <td class="none-mobile"><a href="/{{ $link->link_encurt }}" target="_blank"><ion-icon class="icon-info" name="open-outline"></ion-icon></ion-icon></a></td>
                        <td class="button-info"><a href="/info/{{$link->id}}"><ion-icon class="icon-info"name="settings-outline"></ion-icon></a></td>
                        <td class="data-table">@php echo $link->link_encurt @endphp</td>
                        <td class="data-table link-table none-mobile">{{ $link->clicks }}</td>
                        <td>
                            <form class="none-mobile"action="/delete/{{ $link->id }}" method ="post" style="text-align:center;">
                                @csrf
                                @method("DELETE")
                                <button class="button-delete"> <ion-icon name="trash-outline" ></ion-icon>Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
        @endif
    </section>

@endsection