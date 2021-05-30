@extends("layouts.base")
@section("title", "Link {{ $link_encurt }}")
@section("content")
    <div class="block-links">
        <div class="link-user">
        <a href="/" style="align-self: center;"><button class="button"><ion-icon name="link-outline"></ion-icon>Encurtar mais</button></a> 
            <div class='link-div'>
                <p class="tag-link">Encurtado</p> <p class="link">{{ $link_encurt }}</p>
            </div>
            <div class="link-div">
                <p class="tag-link">Original <p class="link">{{ $link_orig }}</p>
            </div>
        </div>
    </div>
@endsection