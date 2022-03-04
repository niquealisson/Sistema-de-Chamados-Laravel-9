@extends('layouts.main')

@section('title', 'Minhas Solicitações')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
                <th scope="col">Opcões</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>
                        @if (count($event->users) > 0)
                        Solicitação aceita
                        @else
                        Em analise
                        @endif
                    </td>
                    <td><a href="events/edit/{{ $event->id }}" class="btn btn-info edit-btn"><ion-icon name="create"></ion-icon>Editar</a>
                        @if ($event->user_id == 124154)
                        <form action="/events/{{ $event->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash"></ion-icon>Deletar
                            </button>
                        </form>
                        @endif
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não tem eventos, <a href="/events/create">criar evento</a></p>
    @endif

    @can('admin')
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Solicitaçoes Aceitas</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($eventsAsAdmin) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
                <th scope="col">Opcões</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventsAsAdmin as $event)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>
                        @if (count($event->users) > 0)
                        Solicitação Aceita
                        @else
                        Em analise
                        @endif  
                    </td>
                    <td>
                    <form action="/events/leave/{{ $event->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash"></ion-icon>Sair</button>
                    </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não aceitou nem uma Solicitação <a href="/"> Veja todas as solicitações</a> </p>
    @endif
</div>
@endcan
@endsection