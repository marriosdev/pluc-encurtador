@extends("layouts.base")
@section("title", "Info")
@section("content")
<div class="container-info">
    <div class="block-info">
        
        <table class="table-my-links">
            <tr class="table-item-table">
                <th></th>
                <th><h1>Informações</h1></th>
            </tr>
            <tr class="table-item-table">
                <td><ion-icon name="stats-chart-outline"></ion-icon></ion-icon></td>
                <td>{{ $info->clicks }}</td>
            </tr>
            <tr class="table-item-table">
                <td class="table-item-table"><ion-icon name="link-outline"></ion-icon></td>
                <td><a href="{{ $info->link_orig }}">@php echo $_SERVER['HTTP_HOST']@endphp/{{$info->link_encurt }}</a></td>
            </tr >
            <tr class="table-item-table" >
                <td><ion-icon name="earth-outline"></ion-icon></td>
                @if($info->status == 1)
                    <td style="color: #12d112"></ion-icon>Online</td></tr>
                @else
                    <td style="color: #7c0101">Offline</td>
                @endif
        </table>
        <div class="button-group">
            <form  class="item-info"action="/delete/{{ $info->id }}" method="post" >
                @csrf
                @method("DELETE")
                <button class="button-delete"> <ion-icon name="trash-outline"></ion-icon>Excluir</button>
            </form>
            <form  class="item-info"action="/status/{{ $info->id }}" method="post">
                @csrf
                @method("PUT")
                @if($info->status == 1)
                    <button class="button-delete"><ion-icon name="power-outline"></ion-icon>Desligar</button>
                @else
                    <button class="button-delete button-on"><ion-icon name="power-outline"></ion-icon>Ligar</button>
                @endif
            </form>
        </div>
</div>
</div>
@endsection