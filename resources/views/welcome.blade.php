@extends('layouts.main')

@section('title', 'SATI')


@section('content')

<div id="search-container" class="col-md-12">
        <h1>Buscar Solicitação</h1>
        <form action="/" method="get">
                <input type="text" id="search" name="search" class= "form-control" placeholder="Search...">
        </form>
</div>
@can('admin')
<div id="event-container" class="coll-md-12">
        @if ($search)
        <h2>Buscando por: {{ $search }}</h2>
        @else
        <h2>Proximas Solicitaçoes</h2>
        <p class="subtitle">veja as novas solicitaçoes</p>
        @endif
        <div id="cards-container" class="row">
                @foreach ($events as $event)
                <div class="card col-md-3">
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                        <div class="card-body">
                                <p class="card-date">Criação da Solicitação: {{ date('d/m/Y',strtotime($event->date)) }}</p>
                                <h5 class="card-title">{{ $event->title }}</h5>

                                <div class="card-status">
                                        @if (count($event->users) > 0)
                                        Solicitação Aceita
                                        @else
                                        Em analise
                                        @endif
                                </div>
                                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber Mais</a>
                        </div>
                </div>
                @endforeach
                @if(count($events)== 0 && $search)
                <p>Não foi possível encontrar com: {{ $search }} <a href="/">Ver Todos</a></p>
                @elseif(count($events)== 0)
                <p>Não há Solicitacoes</p>
                @endif
        </div>
</div>  
@endcan


@endsection