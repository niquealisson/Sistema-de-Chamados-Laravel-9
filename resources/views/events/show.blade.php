@extends('layouts.main')


@section('title', $event->title)



@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
        </div>

        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="empresa"> <ion-icon name="briefcase"></ion-icon>{{$event->empresa}}</p>

            <p class="events-status"><ion-icon name="stats"></ion-icon>{{ count ($event->users)}}
                @if (count($event->users) > 0)
                Solicitação Aceita
                @else
                Em analise
                @endif
            </p>
            <p class="event-owner"><ion-icon name="person"></ion-icon>{{ $eventOwner['name'] }} </p>
            @if(!$hasUserJoined)
            @can('admin')
            <form action="/events/join/{{ $event->id }}" method="post">
                @csrf
                <a href="/events/join/{{ $event->id }}" 
                    class="btn btn-primary" 
                    id= "event-submit"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    Começar
                </a>
            </form>
            @endcan
            @else
            <p class="already-joined-msg"> Você ja Aceitou a Solictação!</p>
            @endif
            
            <h3></h3>
            <ul id="items-list">
                @foreach ($event->items as $item )
                <li><ion-icon name="clipboard"></ion-icon><span>{{ $item }}</span></li>   
                @endforeach
            </ul>
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre a Solicitação</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
        <div class="col-md-6 offset" id="coment">
            <textarea class="form-control" id="coment" name="" placeholder="Resposta"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Enviar
            </button>
        </div>
</form>
@endsection